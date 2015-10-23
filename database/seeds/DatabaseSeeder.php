<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class DatabaseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    Model::unguard();

    // $this->call(UserTableSeeder::class);
    Role::create([
      'title' => 'Administrator',
      'slug' => 'admin'
    ]);

    Role::create([
      'title' => 'User',
      'slug' => 'user'
    ]);

    Model::reguard();
  }
}
