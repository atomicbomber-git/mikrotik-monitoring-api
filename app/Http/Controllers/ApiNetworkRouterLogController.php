<?php

namespace App\Http\Controllers;

use App\NetworkRouter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PEAR2\Net\RouterOS\Util as RouterOSUtil;
use PEAR2\Net\RouterOS\Client as RouterOSClient;

class ApiNetworkRouterLogController extends Controller
{
    public function index(NetworkRouter $router)
    {
        try {
            $routerUtil = new RouterOSUtil(new RouterOSClient(
                $router->ipv4_address,
                $router->admin_username,
                $router->admin_password,
            ));

            $logEntries = new Collection();

            foreach ($routerUtil->setMenu('/log')->getAll() as $entry) {
                $logEntries->push($entry('time') . ' ' . $entry('topics') . ' ' . $entry('message') . "\n");
            }

            return $logEntries;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
