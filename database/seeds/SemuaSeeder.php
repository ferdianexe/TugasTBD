<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class SemuaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();
    DB::select("CALL insertKategori('Horror')");
    DB::select("CALL insertKategori('Informatika')");
    DB::select("CALL insertKategori('Coding')");
    DB::select("CALL insertKategori('Ekonomi')");
    DB::select("CALL insertKategori('Bahasa')");
    DB::select("CALL insertKategori('Romantis')");
    DB::select("CALL insertKategori('Sci-Fi')");
    DB::select("CALL insertKategori('Java')");
    DB::select("CALL insertKategori('Database')");
    DB::select("CALL insertKategori('Big Data')");
    DB::select("CALL insertKategori('Komedi')");
    DB::select("CALL insertKategori('Fiksi')");
    $array = [
      "Horror",
      "Informatika",
      "Coding",
      "Ekonomi",
      "Bahasa",
      "Romantis",
      "Sci-Fi",
      "Java",
      "Database",
      "Big",
      "Komedi",
      "Fiksi" 
    ];
    for($i = 0 ; $i<500 ; $i++){
        $judul = addslashes($faker->words($faker->numberBetween(1, 6),TRUE)) ;
        $genre1 = $faker->numberBetween(1, 3);
        $genre2 = $faker->numberBetween(4, 6);
        $genre3 = $faker->numberBetween(7, 11);
        $category = "$array[$genre1],"."$array[$genre2],"."$array[$genre3]";
        $price = $faker->numberBetween(50000,100000);
        $tahun = $faker->year('now');
        $tebalBuku = $faker->numberBetween(100,700);
        $namaPenerbit = $faker->numberBetween(1,99);
        $namaPengarang = $faker->numberBetween(1,99);
        DB::select("CALL TambahBuku ('$judul','$tebalBuku','$tahun','$price','$namaPenerbit','$namaPengarang','$category')");
    }

  }
}
