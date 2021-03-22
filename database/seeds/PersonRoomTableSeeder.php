<?php

use Illuminate\Database\Seeder;
use App\Entities\PersonRoom;
class PersonRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '2 Adult, 2 Children',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2 Adult, 1 Children',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2 Adult',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1 Adult',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        PersonRoom::insert($data);
    }
}
