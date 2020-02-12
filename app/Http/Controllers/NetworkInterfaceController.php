<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\Http\Resources\NetworkInterfaceResource;
use App\NetworkRouter;
use Illuminate\Http\Request;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

// Menghubungi router untuk mengambil daftar network interface seperti
// ether1, ether2, ..., dan wlan


class NetworkInterfaceController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            "auth:api"
        ]);
    }

    /**
     * @param Request $request
     * @param NetworkRouter $router
     * @return \Illuminate\Http\Response
     */
    public function index(NetworkRouter $router)
    {
        try {
            $client = new RouterOSClient([
                'host' => $router->host,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $response = $client->query(
                (new RouterOSQuery("/interface/print"))
            )->read();

            $networkInterfaces = NetworkInterfaceResource::collection($response);
        }
        catch (\Exception $exception) {
            return response([
                "message" => "Failed to connect to router",
                "errors" => ["Failed to connect."],
            ]);
        }

        return response($networkInterfaces);
    }
}
