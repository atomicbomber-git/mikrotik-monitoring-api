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

            factory(UserLog::class, 30)
                ->make()
                ->each(function (UserLog $userLog) use($users) {
                    $fakeTime = now()->subSeconds(rand(-3600, -7200));

                    $userLog->forceFill([
                        "user_id" => $users->random()->id,
                        "created_at" => $fakeTime,
                        "updated_at" => $fakeTime,
                    ])->save();
                });
        });
    }
}
