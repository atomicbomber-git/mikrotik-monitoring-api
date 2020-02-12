<?php

namespace App\Http\Controllers;

use App\Http\Resources\NetworkInterfaceResource;
use App\NetworkRouter;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class NetworkInterfaceToggleController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            "auth:api"
        ]);
    }

    public function update(NetworkRouter $router, $id)
    {
        try {
            $client = new RouterOSClient([
                'host' => $router->host,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $networkInterface = collect($client->query(
                (new RouterOSQuery("/interface/print"))
                    ->where('.id', $id)
            )
                ->read())
                ->first();

            $toggleType = $networkInterface["disabled"] === "true" ?
                "enable" :
                "disable";

            $client->query(
                (new RouterOSQuery("/interface/{$toggleType}"))
                    ->equal("numbers", $networkInterface["name"])
            )->read();

            $response = $client->query(
                (new RouterOSQuery("/interface/print"))
                    ->where('.id', $id)
            )->read();
        } catch (\Exception $exception) {
            return response([
                "message" => "Failed to connect to router",
                "errors" => ["Failed to connect."],
            ]);
        }

        $interfaceData = $response[0];

        request()->user()->user_logs()->create([
            "text" => ($toggleType  !== "enable" ? "Mengaktifkan" : "Menonaktifkan") .
                " interface {$interfaceData['name']}"
        ]);

        return NetworkInterfaceResource::make($interfaceData);
    }
}
