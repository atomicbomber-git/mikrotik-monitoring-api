<?php

use App\Constants\UserLevel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Administrator",
            "username" => "administrator",
            "level" => UserLevel::ADMINISTRATOR,
            "email" => "administrator@admin.com",
            "password" => Hash::make("administrator"),
        ]);
    }
}
