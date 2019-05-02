<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class StoredProcedureForTagFavoriteAll extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sql = "CREATE PROCEDURE TagTerfavorit()
        BEGIN
        SELECT KumpulanKategori.Kategori,COUNT(KumpulanKategori.Kategori) as total
        FROM KumpulanPeminjaman
        INNER JOIN KumpulanEksemplar on KumpulanEksemplar.kodeEksemplar = KumpulanPeminjaman.kodeEksemplar
        INNER JOIN KumpulanBukudanKumpulanKategori on KumpulanEksemplar.idBuku = KumpulanBukudanKumpulanKategori.idBuku
        INNER JOIN KumpulanKategori on KumpulanKategori.idKategori = KumpulanBukudanKumpulanKategori.idKategori
        GROUP BY KumpulanKategori.Kategori
        ORDER BY total DESC;
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
      DB::unprepared("DROP PROCEDURE IF EXISTS TagTerfavorit");
  }
}
