<?php

use Illuminate\Database\Seeder;
use App\Entities\Role;

class RoleTableSeeder extends Seeder
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
                'name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Role::insert($data);
    }
}
