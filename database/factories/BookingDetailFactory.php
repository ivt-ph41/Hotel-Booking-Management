<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\BookingDetail;
use App\Entities\Room;
use App\Entities\Booking;
use Faker\Generator as Faker;

$factory->define(BookingDetail::class, function (Faker $faker) {
    $list_room_id = Room::pluck('id');
    $list_booking_id = Booking::pluck('id');
    return [
        'booking_id' => $faker->randomElement($list_booking_id),
        'room_id' => $faker->randomElement($list_room_id),
        'date_start' => $faker->date,
        'date_end' => $faker->date(),
    ];
});
