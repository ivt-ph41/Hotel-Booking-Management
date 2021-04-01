<?php

use Illuminate\Database\Seeder;
use App\Entities\Room;

class RoomTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // factory('App\Entities\Room', 100)->create();
    for ($i = 1; $i <= 10; $i++) {
      $room = [
        'name' => 'Room ' . $i,
        'description' => 'This is room ' . $i,
        'size' => rand(20, 50),
        'price' => rand(20, 100),
        'bed_id' => rand(1, 4),
        'type_id' => rand(1, 5),
        'person_room_id' => rand(1, 4)
      ];
      $image = [
        ['path' => 'anh1.jpg', 'room_id' => $i],
        ['path' => 'anh2.jpg', 'room_id' => $i],
        ['path' => 'anh3.jpg', 'room_id' => $i],
        ['path' => 'anh4.jpg', 'room_id' => $i],
        ['path' => 'anh5.jpg', 'room_id' => $i]
      ];
      $room = Room::create($room);
      $room->images()->insert($image);
    }
  }
}
