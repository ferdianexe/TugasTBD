<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class PengarangSeeder extends Seeder
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
      $namaPengarang = addslashes($faker->name);
      DB::select("CALL insertPengarang('$namaPengarang')");
    }
  }
}
