<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AturanDendaSeeder extends Seeder
{
    /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::select("CALL CreateAturanDenda (1,1000)");
    DB::select("CALL CreateAturanDenda (2,2000)");
    DB::select("CALL CreateAturanDenda (3,3000)");
    DB::select("CALL CreateAturanDenda (4,4000)");
    DB::select("CALL CreateAturanDenda (5,5000)");

    DB::select("CALL CreateAturanDenda (6,6000)");
    DB::select("CALL CreateAturanDenda (7,7000)");
    DB::select("CALL CreateAturanDenda (8,8000)");
    DB::select("CALL CreateAturanDenda (9,9000)");
    DB::select("CALL CreateAturanDenda (10,10000)");
  }

}


