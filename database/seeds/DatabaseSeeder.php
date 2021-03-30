<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);

        // $this->call(UserTableSeeder::class);

        // $this->call(ProfileTableSeeder::class);

        $this->call(BedTableSeeder::class);

        $this->call(TypeTableSeeder::class);

        $this->call(PersonRoomTableSeeder::class);

        // $this->call(RoomTableSeeder::class);

        // $this->call(ImageTableSeeder::class);

        // $this->call(CommentTableSeeder::class);

        // $this->call(BookingTableSeeder::class);

        // $this->call(BookingDetailTableSeeder::class);
    }
}
