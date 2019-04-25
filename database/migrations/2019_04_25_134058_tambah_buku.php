<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class TambahBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("ALTER TABLE kumpulankatadanbuku ADD kemunculankata INT NOT NULL AFTER idBuku");
      $sql = "CREATE PROCEDURE TambahBuku
      (
        IN judul_param varchar(50),
        IN tebal_param INT,
        IN tahun_param INT,
        IN harga_param decimal(15,2),
        IN penerbit_param INT,
        IN pengarang_param INT
      )
       BEGIN
        DECLARE id_param INT;
        DECLARE start_val INT;
        DECLARE end_val INT ;
        DECLARE judul_val varchar(50);
        DECLARE cur_kata varchar(50);
        CREATE TABLE pecahanKata(kata varchar(50),id INT);
        INSERT INTO kumpulanbuku(nama,tebalBuku,tahunTerbit,hargaBuku,idPenerbit,idPengarang)
        VALUES (judul_param,tebal_param,tahun_param,harga_param,penerbit_param,pengarang_param);
        
        SELECT idBuku INTO id_param
        FROM kumpulanBuku
        ORDER BY idBuku DESC
        LIMIT 1;

        SET start_val = 1;
        SET judul_val = (SELECT LOWER(judul_param)); -- jadikan huruf kecil semua
        WHILE start_val != 0 DO
          SELECT INSTR(judul_val,' ') INTO end_val;
          IF end_val = 0 THEN
             SET end_val = 500 ;
             SELECT SUBSTRING(judul_val,start_val,end_val) INTO cur_kata ;
             INSERT INTO pecahanKata(kata,id)
             VALUES(cur_kata,id_param);
             SET start_val = 0 ;
          ELSE
             SELECT SUBSTRING(judul_val,start_val,end_val) INTO cur_kata ;
             INSERT INTO pecahanKata(kata,id)
             VALUES(cur_kata,id_param);
             SELECT SUBSTRING(judul_val,(end_val+1),300) INTO judul_val ;
          END IF;
          -- insert kata baru, baru = kalo di kumpulankata, kata tersebut belum ada
          INSERT INTO kumpulankata(kata)
          SELECT * FROM (SELECT cur_kata) as TEMP
          WHERE NOT EXISTS (SELECT kata FROM kumpulankata WHERE kata=cur_kata ) LIMIT 1;
        END WHILE;
        -- masukan kata kedalam tablenya
        INSERT INTO kumpulankatadanbuku
        SELECT kata,id,count(kata)
        FROM pecahanKata
        GROUP BY kata,id;
        -- bikin temporary table harus didrop di MySQL
        drop table pecahanKata ;
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
      DB::statement("ALTER TABLE kumpulankatadanbuku DROP kemunculankata");
      DB::unprepared(
        "DROP PROCEDURE TambahBuku"
      );
    }
}
