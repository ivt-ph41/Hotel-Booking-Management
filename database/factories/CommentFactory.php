<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Comment;
use App\Entities\Room;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $list_user_id = User::pluck('id');
    $list_room_id = Room::pluck('id');
    return [
        'user_id' => $faker->randomElement($list_user_id),
        'room_id' => $faker->randomElement($list_room_id),
        'content' => $faker->text,
    ];
});
