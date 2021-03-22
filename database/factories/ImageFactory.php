<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Image;
use App\Entities\Room;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $list_room_id = Room::pluck('id');
    return [
        'path' => 'https://i.ytimg.com/vi/AGozjq41N9o/maxresdefault.jpg',
        'room_id' => $faker->randomElement($list_room_id)
    ];
});
