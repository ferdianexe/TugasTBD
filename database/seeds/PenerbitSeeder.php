<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class PenerbitSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();
    for($i = 0 ; $i < 100 ;$i++){
      $namaPenerbit = addslashes($faker->name);
      DB::select("CALL insertPenerbit('$namaPenerbit')");
    }
  }
}
