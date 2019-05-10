<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SearchByTagStoredProcedure extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sql = "CREATE PROCEDURE searchByFilter(
      IN idKategoriParam int,
      IN page_param INT
    )
      BEGIN
        DECLARE offset_val INT ;
        SET offset_val = page_param*12;
        IF page_param = -1 THEN
          SELECT tableHasil.idBuku,KumpulanBuku.nama
          FROM(
            SELECT idBuku
            FROM KumpulanBukuDanKumpulanKategori
            WHERE idKategori = idKategoriParam
          ) as tableHasil
          INNER JOIN KumpulanBuku on KumpulanBuku.idBuku = tableHasil.idBuku;
        ELSE
        SELECT tableHasil.idBuku,KumpulanBuku.nama
          FROM(
            SELECT idBuku
            FROM KumpulanBukuDanKumpulanKategori
            WHERE idKategori = idKategoriParam
          ) as tableHasil
          INNER JOIN KumpulanBuku on KumpulanBuku.idBuku = tableHasil.idBuku
          LIMIT offset_val,12;
        END IF;
      END
    ";
    DB::connection()->getPdo()->exec($sql);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::unprepared("DROP PROCEDURE searchByFilter");
  }
}
