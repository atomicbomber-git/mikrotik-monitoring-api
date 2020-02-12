<?php

namespace App\Http\Controllers;

use App\NetworkRouter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use RouterOS\Client as RouterOSClient;

/**
 * Menampilkan status konektivitas router di halaman web
 */


class NetworkRouterStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Request $request)
    {
        $network_routers = NetworkRouter::query()
            ->get();

        foreach ($network_routers as $network_router) {

            $network_router->isConnected = true;
            $network_router->connectionErrors = new Collection();

            try {
                new RouterOSClient([
                    'host' => $network_router->host,
                    'user' => $network_router->admin_username,
                    'pass' => $network_router->admin_password,
                ]);
            }
            catch (\Exception $e) {
                $network_router->isConnected = false;
                $network_router->connectionErrors->push($e->getMessage());
            }
        }

        return view("network-router-status.index", compact(
            "network_routers"
        ));
    }
}
