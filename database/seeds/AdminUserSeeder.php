<?php

use App\Constants\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    const USERS = [
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
        foreach (static::USERS as $username) {
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
