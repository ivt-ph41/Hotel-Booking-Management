<?php

use Illuminate\Database\Seeder;
use App\Entities\Type;
class TypeTableSeeder extends Seeder
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
                'name' => 'Deluxe Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Premium King Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Luxury Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Single Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Double Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Type::insert($data);
    }
}
