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
    factory(App\User::class, 10)->create()->each(function($user){
      $user->profile()->save(factory(App\Entities\Profile::class)->make());
    });
    // $user = [
    //   'email' => 'admin@gmail.com',
    //   'password' => Hash::make('ngocphuocha'),
    //   'role_id' => Role::ADMIN_ROLE
    // ];
    // $profile = [
    //   'name' => 'Tran Ngoc Phuoc',
    //   'address' => 'Hoi An',
    //   'phone' => '0984641362'
    // ];
    // // create user
    // $user = User::create($user);
    // $user->profile()->create($profile);
  }
}
