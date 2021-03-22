<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Booking;
use App\User;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    $list_user_id = User::pluck('id');
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'status' => rand(0, 2),
        'user_id' => $faker->randomElement($list_user_id),
    ];
});
