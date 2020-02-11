<?php

use App\Constants\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    const SUPER_ADMINS = [
        "superadmin",
    ];

    const ROUTER_ADMINS = [
      "administrator",
      "administrator2",
      "administrator3",
      "administrator4",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::SUPER_ADMINS as $username) {
            User::create([
                "name" => "Administrator",
                "username" => "{$username}",
                "level" => UserLevel::SUPER_ADMINISTRATOR,
                "email" => "{$username}@superadmin.com",
                "password" => Hash::make("{$username}"),
            ]);
        }

        foreach (static::ROUTER_ADMINS as $username) {
            User::create([
                "name" => "Administrator",
                "username" => "{$username}",
                "level" => UserLevel::ADMINISTRATOR,
                "email" => "{$username}@admin.com",
                "password" => Hash::make("{$username}"),
            ]);
        }
    }
}
