<?php

namespace App\Http\Controllers;

use App\Helpers\Formatter;
use App\NetworkRouter;
use RouterOS\Client as RouterOSClient;
use RouterOS\Query as RouterOSQuery;

class ApiNetworkRouterLogController extends Controller
{
    public function index(NetworkRouter $router)
    {
        $logs = [];

        try {
            $client = new RouterOSClient([
                'host' => $router->ipv4_address,
                'user' => $router->admin_username,
                'pass' => $router->admin_password,
            ]);

            $log_query_results = $client->query(
                (new RouterOSQuery("/log/print"))
            )->read();

            foreach ($log_query_results as $log_query_result) {
                $temp = [];

                foreach ($log_query_result as $key => $value) {
                    $temp[Formatter::cleanKey($key)] = $value;
                }

                $logs[] = $temp;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

        return $logs;
    }
}
