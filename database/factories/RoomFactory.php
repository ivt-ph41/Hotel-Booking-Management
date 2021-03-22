<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Room;
use App\Entities\Bed;
use App\Entities\Type;
use App\Entities\PersonRoom;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    $list_bed_id = Bed::pluck('id');
    $list_type_room_id = Type::pluck('id');
    $list_person_room_id = PersonRoom::pluck('id');
    return [
        'name' => $faker->name,
        'price' => rand(1,100),
        'size' => rand(30,50),
        'description' => $faker->text,
        'bed_id' => $faker->randomElement($list_bed_id),
        'type_id' => $faker->randomElement($list_type_room_id),
        'person_room_id' => $faker->randomElement($list_person_room_id),
    ];
});
