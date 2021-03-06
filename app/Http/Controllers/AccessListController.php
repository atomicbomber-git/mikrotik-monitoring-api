<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\NetworkRouter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

/**
 * Manajemen access list; Menampilkan daftar item access list yang ada pada router,
 * dan menyediakan fitur untuk menambah dan menghapus setiap item access list yang ada.
 */


class AccessListController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            "auth:api"
        ]);
    }

    public function index(NetworkRouter $router)
    {
        $access_lists = [];

        try {
            $client = new RouterOSClient([
                'host' => $router->host,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $raw_access_lists = $client->query(
                (new RouterOSQuery("/interface/wireless/access-list/print"))
            )->read();

            foreach ($raw_access_lists as $raw_access_list) {
                $temp = [];

                foreach ($raw_access_list as $key => $value) {
                    $temp[Formatter::cleanKey($key)] = $value;
                }

                $access_lists[] = $temp;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

        return $access_lists;
    }

    public function create(Request $request, NetworkRouter $router)
    {
        $routerQueryParameters = $request->validate([
            "network_interface" => "required|string",
            "mac_address" => "required|string",
            "authentication" => "required|in:yes,no",
        ]);

        try {
            $client = new RouterOSClient([
                'host' => $router->host,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $query = $this->getBanQuery($routerQueryParameters["network_interface"], $routerQueryParameters["mac_address"]);

            $response = $client->query($query)->read();
        }
        catch (\Exception $e) {
            return [
                "status" => "error"
            ];
        }
        finally {
            request()->user()->user_logs()->create([
                "text" => "Mem-ban client dengan MAC address {$routerQueryParameters['mac-address']}"
            ]);
        }

        return [
            "status" => "success",
        ];
    }

    public function delete(Request $request,  NetworkRouter $router)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            "id" => "required"
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = $validator->validated();

        try {
            $client = new RouterOSClient([
                'host' => $router->host,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $query = (new RouterOSQuery("/interface/wireless/access-list/remove"))
                ->equal(".id", $data["id"]);

            $accessListData = collect($client->query(
                (new RouterOSQuery("/interface/wireless/access-list/print"))
                    ->where('.id', $data["id"])
            )->read())->first();

            $client->query($query)->read();

        }
        catch (\Exception $e) {
            return [
                "status" => "error",
                "message" => $e->getMessage(),
            ];
        }
        finally {
            request()->user()->user_logs()->create([
                "text" => "Menghapus ban client dengan MAC address {$accessListData['mac-address']}"
            ]);
        }

        return [
            "status" => "success",
            "message" => "",
        ];
    }

    /**
     * @param $network_interface
     * @param $mac_address
     * @return RouterOSQuery
     * @throws \RouterOS\Exceptions\QueryException
     */
    private function getBanQuery($network_interface, $mac_address): RouterOSQuery
    {
        $query = (new RouterOSQuery("/interface/wireless/access-list/add"))
            ->equal("interface", $network_interface)
            ->equal("mac-address", $mac_address);
        return $query;
    }
}
