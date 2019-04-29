<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class TagFavoritTiapAnggota extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    
    $sql ="CREATE PROCEDURE TagFavoritPerAnggota(
      IN id_val INT
    ) 
    BEGIN
      DECLARE totalPeminjaman INT ;
      SELECT 
        count(kodeEksemplar) INTO totalPeminjaman
      FROM 
        KumpulanPeminjaman
      WHERE 
        idUser = id_val ;
      SELECT 
        kodeEksemplar 
      FROM 
        KumpulanPeminjaman
      WHERE 
        idUser = id_val ;
    END";

    $sql = "CREATE PROCEDURE tambahEksemplar
    (
      IN kode_eksemplar_val INT,
      IN kode_buku_val INT
    )
      BEGIN
        INSERT INTO 
          kumpulaneksemplar (kodeEksemplar,idBuku,statusPeminjaman)
        SELECT 
          *
        FROM (SELECT kode_eksemplar_val,kode_buku_val,0) as temp
        WHERE NOT EXISTS (
          SELECT 
            kode_buku_val 
          FROM 
            kumpulaneksemplar
          WHERE 
            kodeEksemplar = kode_eksemplar_val 
          ) LIMIT 1;
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
    // DB::unprepared(
    //   "DROP PROCEDURE TagFavoritPerAnggota"
    // );
    DB::unprepared(
      "DROP PROCEDURE tambahEksemplar"
    );
  }
}
