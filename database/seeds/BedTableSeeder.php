<?php

use Illuminate\Database\Seeder;
use App\Entities\Bed;
class BedTableSeeder extends Seeder
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
                'name' => 'King Bed',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Queen Bed',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Single Bed',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Double Bed',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        
        Bed::insert($data);
    }
}
