<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\NetworkRouter;
use Illuminate\Http\Request;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class ApiNetworkRouterWirelessRegistrationTableController extends Controller
{
    public function index(Request $request, NetworkRouter $router)
    {
        $clients = [];

        try {
            $client = new RouterOSClient([
                'host' => $router->ipv4_address,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $registered_clients = $client->query(
                (new RouterOSQuery("/interface/wireless/registration-table/print"))
            )->read();

            foreach ($registered_clients as $registered_client) {
                $temp = [];

                foreach ($registered_client as $key => $value) {
                    $temp[Formatter::cleanKey($key)] = $value;
                }

                $clients[] = $temp;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

        return $clients;
    }
}
