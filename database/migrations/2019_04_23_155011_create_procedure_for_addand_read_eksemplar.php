<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProcedureForAddandReadEksemplar extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sql = "CREATE PROCEDURE AddEksemplar 
    (
      IN kodeBuku_param int,
      IN kodeEksemplar_param int
    )
    BEGIN
      INSERT INTO kumpulanEksemplar(kodeEksemplar,idBuku,statusPeminjaman)
      VALUES (kodeEksemplar_param,kodeBuku_param,0);
    END";
    DB::connection()->getPdo()->exec($sql);
    $sql = "CREATE PROCEDURE checkEksemplar 
    (
      IN kodeBuku_param int,
      IN kodeEksemplar_param int
    )
    BEGIN
      SELECT kodeEksemplar,idBuku
      FROM kumpulanEksemplar
      WHERE kodeEksemplar = kodeEksemplar_param AND idBuku = kodeBuku_param;
    END";
    DB::connection()->getPdo()->exec($sql);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::unprepared(
      "DROP PROCEDURE AddEksemplar"
    );

    DB::unprepared(
      "DROP PROCEDURE checkEksemplar"
    );
  }
}
