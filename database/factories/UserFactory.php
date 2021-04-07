<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Entities\Role;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $list_role = Role::pluck('id');
    return [
        'email' => $faker->unique()->safeEmail,
        'role_id' => $faker->randomElement($list_role),
        'email_verified_at' => now(),
        'password' => bcrypt('ngocphuocha'), // password
        'remember_token' => Str::random(10),
    ];
});
