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
      'title' => '管理员',
      'slug' => 'admin'
    ]);

    Role::create([
      'title' => '用户',
      'slug' => 'user'
    ]);

    Model::reguard();
  }
}
