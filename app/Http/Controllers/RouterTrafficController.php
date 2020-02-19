<?php

namespace App\Http\Controllers;

use App\Http\Resources\RouterTrafficResource;
use App\NetworkRouter;
use Illuminate\Http\Request;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class RouterTrafficController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RouterTrafficResource|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, NetworkRouter $router)
    {
        try {
            $client = new RouterOSClient([
                'host' => $router->host,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $router_response = $client->query(
                (new RouterOSQuery("/interface/monitor-traffic"))
                    ->add("=interface=aggregate")
                    ->add("=once")
            )->read();

            return RouterTrafficResource::make($router_response[0]);
        }
        catch (\Exception $exception) {
            return response(["message" => "error"], 400);
        }
    }
}
