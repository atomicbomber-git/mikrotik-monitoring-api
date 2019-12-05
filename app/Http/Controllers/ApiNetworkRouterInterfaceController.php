<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\NetworkRouter;

use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class ApiNetworkRouterInterfaceController extends Controller
{
    public function index(NetworkRouter $router)
    {
        $client = new RouterOSClient([
            'host' => $router->ipv4_address,
            'user' => $router->admin_username,
            'pass' => $router->admin_password,
        ]);

        $response = $client->query(
            (new RouterOSQuery("/interface/print"))
        )->read();

        $networkInterfaces = collect($response)
            ->map(function ($networkInterface) {
                return collect($networkInterface)->mapWithKeys(function ($value, $key) {
                    return [
                        Formatter::cleanKey($key) =>
                        $value
                    ];
                });
            });

        return $networkInterfaces;
    }
}
