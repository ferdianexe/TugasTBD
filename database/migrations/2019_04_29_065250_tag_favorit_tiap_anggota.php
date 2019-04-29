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
      CREATE TABLE kategoriFavorit(kodeKategoriFavorit int);
      SELECT 
        count(kodeEksemplar) INTO totalPeminjaman
      FROM 
        KumpulanPeminjaman
      WHERE 
        idUser = id_val ;


      INSERT INTO kategoriFavorit
      SELECT 
        kumpulanBukudankumpulanKategori.idKategori
      FROM 
        KumpulanPeminjaman
      INNER JOIN kumpulanEksemplar on kumpulanEksemplar.kodeEksemplar = KumpulanPeminjaman.kodeEksemplar
      INNER JOIN kumpulanBukudankumpulanKategori on kumpulanBukudankumpulanKategori.idBuku = kumpulanEksemplar.idBuku
      WHERE 
        KumpulanPeminjaman.idUser = id_val ;
      SELECT * 
      FROM KumpulanKategori
      INNER JOIN (
        SELECT kodeKategoriFavorit,count(kodeKategoriFavorit) as total
        FROM kategoriFavorit
        GROUP BY kodeKategoriFavorit
      ) as table2 on table2.kodeKategoriFavorit = KumpulanKategori.idKategori
      ORDER BY table2.total DESC ;
      
      DROP TABLE kategoriFavorit;
    END";


    DB::connection()->getPdo()->exec($sql);

    
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
    DB::unprepared(
      "DROP PROCEDURE TagFavoritPerAnggota"
    );
    DB::unprepared(
      "DROP PROCEDURE tambahEksemplar"
    );
  }
}
