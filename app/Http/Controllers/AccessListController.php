<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\NetworkRouter;
use Illuminate\Http\Request;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class AccessListController extends Controller
{
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

        $routerQueryParameters["interface"] = $routerQueryParameters["network_interface"];
        $routerQueryParameters["mac-address"] = $routerQueryParameters["mac_address"];
        unset($routerQueryParameters["network_interface"]);
        unset($routerQueryParameters["mac_address"]);

        try {
            $client = new RouterOSClient([
                'host' => $router->host,
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
        }
        catch (\Exception $e) {
            return [
                "status" => "error"
            ];
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

            $client->query($query)->read();
        }
        catch (\Exception $e) {
            return [
                "status" => "error",
                "message" => $e->getMessage(),
            ];
        }


        return [
            "status" => "success",
            "message" => "",
        ];
    }
}
