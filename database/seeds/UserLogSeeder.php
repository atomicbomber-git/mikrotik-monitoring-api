<?php

use App\User;
use App\UserLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $users = User::query()->select("id")->get();

            foreach ($users as $user) {
                factory(UserLog::class, 30)
                    ->create([
                        "user_id" => $user->id
                    ]);
            }
        });
    }
}
