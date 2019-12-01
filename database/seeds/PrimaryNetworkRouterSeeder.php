<?php

use App\Constants\UserLevel;
use App\User;
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
        $adminUser = User::query()
            ->where("level", UserLevel::ADMINISTRATOR)
            ->first();

        $adminUser->network_routers()
            ->create([
                "name" => "Router Utama",
                "ipv4_address" => "192.168.88.1",
                "is_primary" => 1,
                "admin_username" => "admin",
                "admin_password" => "",
            ]);
    }
}
