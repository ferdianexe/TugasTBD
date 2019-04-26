<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateBobotTiapKataDalamBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("ALTER TABLE kumpulankatadanbuku ADD BobotTiapKataDalamBuku FLOAT NOT NULL DEFAULT 0 AFTER idBuku");

      $sql = "CREATE PROCEDURE updateBobot()
        BEGIN
            UPDATE kumpulankatadanbuku
            INNER JOIN kumpulankata ON kumpulankata.kata = kumpulankatadanbuku.kata
            SET kumpulankatadanbuku.BobotTiapKataDalamBuku = (1+LOG(2,kumpulankatadanbuku.kemunculankata))*kumpulankata.nilaiKata;
        END";
       DB::connection()->getPdo()->exec($sql);

      $sql = "CREATE PROCEDURE masukanKategoriKeBuku(
        IN id_param INT,
        IN kategori_param varchar(150)
        )
        BEGIN
          DECLARE start_val INT; -- untuk posisi awal diambil start valuenya di list of kategori
          DECLARE end_val INT; -- posisi terakhir biar bisa dipotong menjadi 1 kata khusus dalam kategori
          DECLARE curcat_val varchar(150); -- kategori tiapnya yang sudah dipotong
          DECLARE kategori_val varchar(150); -- kategori simpanan sebagai kalimat yang nanti dipecah
          DECLARE kategoriid_val INT; -- kategori id yang akan di input kedalam table
          SET start_val = 1 ; -- set dlu jadi 1
          SET kategori_val = kategori_param; -- kategori yang dipecah di set terlebih dahulu
          WHILE start_val != 0 DO -- selama kategori itu masih kumpulan kata kata loop
          SELECT INSTR(kategori_val,',') INTO end_val; -- dapatkan value terakhirnya
            IF end_val = 0 THEN -- jika ini adalah kata terakhir
              SET end_val = 500 ;
              SELECT SUBSTRING(kategori_val,start_val,500) INTO curcat_val ; -- masukan kedalam kategori yang diolah tiap katanya
              SET start_val = 0 ; -- biar keluar loop
            ELSE -- masuk sini jika kategori masih lebih dari 1
              SELECT SUBSTRING(kategori_val,start_val,(end_val-1)) INTO curcat_val ; -- masukan kedalam kategori yang diolah tiap katanya
              SELECT SUBSTRING(kategori_val,(end_val+1),300) INTO kategori_val ; -- update string kategorinya
            END IF;
            SELECT idKategori INTO kategoriid_val 
            FROM kumpulankategori
            WHERE kategori = curcat_val
            LIMIT 1; -- cari idkategori berdasarkan kategorinya ambil papling atas saja
            INSERT INTO kumpulanbukudankumpulankategori(idBuku,idKategori)
            SELECT id_param,kategoriid_val
            FROM kumpulanKategori
            WHERE EXISTS(SELECT * FROM KumpulanKategori WHERE idKategori = kategoriid_val);
            -- masukan data tersebut jika emang exist
          END WHILE;
          -- keluar loop
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
      DB::statement("ALTER TABLE kumpulankatadanbuku DROP BobotTiapKataDalamBuku");
      DB::unprepared("DROP PROCEDURE updateBobot");
      DB::unprepared("DROP PROCEDURE masukanKategoriKeBuku");
    }
}
