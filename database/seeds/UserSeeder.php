<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      DB::table('users')->insert([
        'name' => 'Admin Perpustakaan',
        'email' => 'Admin@eaea.com',
        'statusAktif' => '1',
        'tglLahir' => '2019-04-09',
        'tglGabung' => '2019-04-30',
        'username' => 'root',
        'password' => bcrypt('12345678'),
        'alamat' => 'Unpar Weh dimana',
        'hakStatus' => 1,
        'updated_at' => '2019-04-30',
        'created_at' => NULL,
      ]);
      for($i = 0 ; $i < 100 ;$i++){
        DB::table('users')->insert([
          'name' => $faker->name,
          'email' => $faker->email,
          'statusAktif' => '1',
          'tglLahir' => '2019-04-09',
          'tglGabung' => '2019-04-30',
          'username' => $faker->userName,
          'password' => bcrypt('secret'),
          'alamat' => $faker->streetAddress,
          'hakStatus' => 0,
          'updated_at' => '2019-04-30',
          'created_at' => NULL,
        ]);
      }
    }
}
