<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Profile;
use App\User;

use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $list_user_id = User::pluck('id');
    return [
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'phone' => $faker->phoneNumber,
        'user_id' => $faker->randomElement($list_user_id),
    ];
});
