<?php

namespace App\Http\Controllers;

use App\NetworkRouter;
use Illuminate\Database\Eloquent\Collection;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class ApiNetworkRouterLogController extends Controller
{
    public function index(NetworkRouter $router)
    {
        try {
            $client = new RouterOSClient([
                'host' => $router->ipv4_address,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
