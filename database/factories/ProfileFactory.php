<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Profile;
use App\User;

use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'phone' => '0999999999',
    ];
});
