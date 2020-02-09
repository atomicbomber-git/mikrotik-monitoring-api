<?php

namespace App\Http\Controllers;
use App\NetworkRouter;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class NetworkInterfaceToggleController extends Controller
{
    public function update(NetworkRouter $router, $id)
    {
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

        $response = $client->query(
            (new RouterOSQuery("/interface/{$toggleType}"))
                ->equal("numbers", $networkInterface["name"])
        )->read();

        $response = $client->query(
            (new RouterOSQuery("/interface/print"))
                ->where('.id', $id)
        )->read();

        dump($response[0] ?? null);

        return $response[0] ?? null;
    }
}
