<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserLog;
use Faker\Generator as Faker;

$factory->define(UserLog::class, function (Faker $faker) {
    return [
        "text" => $faker->sentence
    ];
});
