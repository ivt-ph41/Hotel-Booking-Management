<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Entities\Role;
use App\User;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // factory('App\User', 5)->create();
    $user = [
      'email' => 'admin@gmail.com',
      'password' => Hash::make('ngocphuocha'),
      'role_id' => Role::ADMIN_ROLE
    ];
    $profile = [
      'name' => 'Tran Ngoc Phuoc',
      'address' => 'Hoi An',
      'phone' => '0984641362'
    ];
    // create user
    $user = User::create($user);
    $user->profile()->create($profile);
  }
}
