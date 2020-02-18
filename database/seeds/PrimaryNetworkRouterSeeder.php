<?php

use App\NetworkRouter;
use Illuminate\Database\Seeder;

class PrimaryNetworkRouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NetworkRouter::create([
            "name" => "Router Utama",
            "host" => "192.168.88.1",
            "admin_username" => "admin",
            "admin_password" => "",
        ]);
    }
}
