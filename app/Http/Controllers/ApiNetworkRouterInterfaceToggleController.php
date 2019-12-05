<?php

namespace App\Http\Controllers;
use App\NetworkRouter;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class ApiNetworkRouterInterfaceToggleController extends Controller
{
    public function update(NetworkRouter $router, $id)
    {
        $client = new RouterOSClient([
            'host' => $router->ipv4_address,
            'user' => $router->admin_username,
            'pass' => $router->admin_password,
        ]);

        // $networkInterfaceIsDisabled = collect($client->query(
        //     (new RouterOSQuery("/interface/print"))
        //         ->where('.id', $id)
        // )
        // ->read())
        // ->first()
        // ["disabled"] ?? true;

        $response = $client->query(
            (new RouterOSQuery("/interface/set"))
                ->equal("disabled", "yes")
                ->where("name", "ether4")
        )

        ->read(false);

        // $response = collect($client->query(
        //     (new RouterOSQuery("/interface/print"))
        //         ->where('.id', $id)
        // )
        // ->read())
        // ->first();

        return $response;

        // return $networkInterfaceIsDisabled;

        // $networkInterfaces = collect($response)
        //     ->map(function ($networkInterface) {
        //         return collect($networkInterface)->mapWithKeys(function ($value, $key) {
        //             return [
        //                 Formatter::cleanKey($key) =>
        //                 $value
        //             ];
        //         });
        //     });

        // return $networkInterfaces;
    }
}
