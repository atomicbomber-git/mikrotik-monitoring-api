<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\NetworkRouter;
use Illuminate\Http\Request;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class ApiNetworkRouterWirelessAccessListController extends Controller
{
    public function index(NetworkRouter $router)
    {
        $access_lists = [];

        try {
            $client = new RouterOSClient([
                'host' => $router->ipv4_address,
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
            "interface" => "required|string",
            "mac-address" => "required|string",
            "authentication" => "required|in:yes,no",
        ]);

        try {
            $client = new RouterOSClient([
                'host' => $router->ipv4_address,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $query = new RouterOSQuery("/interface/wireless/access-list/add");

            foreach ($routerQueryParameters as $routerQueryParameterKey => $routerQueryParameterValue) {
                $query->equal(
                    $routerQueryParameterKey,
                    $routerQueryParameterValue,
                );
            }

            $response = $client->query($query)->read();

            return $response;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
