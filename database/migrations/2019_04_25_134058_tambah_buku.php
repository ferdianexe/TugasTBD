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
      DB::statement("ALTER TABLE KumpulanKatadanBuku ADD kemunculankata INT NOT NULL DEFAULT 1 AFTER idBuku");
      $sql = "CREATE PROCEDURE TambahBuku
      (
        IN judul_param varchar(255),
        IN tebal_param INT,
        IN tahun_param INT,
        IN harga_param decimal(15,2),
        IN penerbit_param INT,
        IN pengarang_param INT,
        IN kategori_param varchar(150)
      )
       BEGIN
        DECLARE id_param INT;
        DECLARE start_val INT;
        DECLARE end_val INT ;
        DECLARE judul_val varchar(255);
        DECLARE cur_kata varchar(255);
        CREATE TABLE pecahanKata(kata varchar(255),id INT);
        INSERT INTO KumpulanBuku(nama,tebalBuku,tahunTerbit,hargaBuku,idPenerbit,idPengarang)
        VALUES (judul_param,tebal_param,tahun_param,harga_param,penerbit_param,pengarang_param);
        
        SELECT idBuku INTO id_param
        FROM KumpulanBuku
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
          -- insert kata baru, baru = kalo di KumpulanKata, kata tersebut belum ada
          INSERT INTO KumpulanKata(kata)
          SELECT * FROM (SELECT cur_kata) as TEMP
          WHERE NOT EXISTS (SELECT kata FROM KumpulanKata WHERE kata=cur_kata ) LIMIT 1;
        END WHILE;
        -- masukan kata kedalam tablenya
        INSERT INTO KumpulanKatadanBuku(kata,idBuku,kemunculanKata)
        SELECT kata,id,count(kata)
        FROM pecahanKata
        GROUP BY kata,id;
        -- bikin temporary table harus didrop di MySQL
        drop table pecahanKata ;
        -- kalo udah nambahin kata auto update idf
        CALL Updateidf();
        -- Tambahkan semua kategori tadi kedalam buku
        CALL masukanKategoriKeBuku(id_param,kategori_param);
       END
      ";
       DB::connection()->getPdo()->exec($sql);
       $sql = "CREATE PROCEDURE updateidf()
       BEGIN
        DECLARE totalbuku_val INT ;
        DECLARE is_finished INT;
        DECLARE cur_kata_val varchar(255) ;
        DECLARE hasil_kata_val FLOAT ;
        DECLARE kata_cursor CURSOR FOR SELECT kata,hasilPerhitungan FROM temp;
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET is_finished =  1;

        CREATE TABLE temp(totalbuku INT,totalKemunculan INT,hasilPerhitungan float,kata varchar(50));

        SELECT count(idBuku) INTO totalbuku_val
        FROM KumpulanBuku;

        INSERT INTO temp (totalbuku,totalkemunculan,hasilPerhitungan,kata)
        SELECT totalbuku_val,COUNT(idBuku),(1+LOG(2,((totalbuku_val*1.0)/COUNT(idBuku)))),kata
        FROM KumpulanKatadanBuku
        GROUP BY kata;

        SET is_finished = 0 ;

        OPEN kata_cursor;

        get_kata: LOOP 
        FETCH kata_cursor INTO cur_kata_val,hasil_kata_val;
          IF is_finished = 1 THEN 
          LEAVE get_kata;
          END IF;

          UPDATE KumpulanKata
          SET nilaiKata = hasil_kata_val
          WHERE kata = cur_kata_val;

        END LOOP get_kata;

        drop table temp;
        -- Setiap udah berubah idfnya maka semua bobot akan berubah juga
        CALL updateBobot();
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
      DB::statement("ALTER TABLE KumpulanKatadanBuku DROP kemunculankata");
      DB::unprepared("DROP PROCEDURE updateidf");
      DB::unprepared(
        "DROP PROCEDURE TambahBuku"
      );
    }
}
