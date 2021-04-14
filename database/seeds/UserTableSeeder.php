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
    factory(App\User::class, 10)->create()->each(function ($user) {
      $user->profile()->save(factory(App\Entities\Profile::class)->make());
    });
  }
}
