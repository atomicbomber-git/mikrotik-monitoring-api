<?php

namespace App\Http\Controllers;

use App\NetworkRouter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PEAR2\Net\RouterOS\Util as RouterOSUtil;
use PEAR2\Net\RouterOS\Client as RouterOSClient;
use PEAR2\Net\RouterOS\Response as RouterOSResponse;

class ApiNetworkRouterInterfaceController extends Controller
{
    public function index(NetworkRouter $router)
    {
        try {
            $routerUtil = new RouterOSUtil(new RouterOSClient(
                $router->ipv4_address,
                $router->admin_username,
                $router->admin_password,
            ));

            $entries = new Collection();

            foreach ($routerUtil->setMenu('/interface/wireless/registration-table')->getAll() as $entry) {
                $connectedDevice = [];
                foreach ($entry as $attribute_name => $attribute_value) {
                    $connectedDevice[$attribute_name] = $attribute_value;
                }
                $entries->push($connectedDevice);
            }

            return $entries;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
