<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class Createstoredprocedureforrecommendation extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement(
      'CREATE TABLE RecommendationTable
      (
        kodeBukuPertama int,
        kodeBukuKedua int,
        support float
      )'
    );

    DB::statement(
      'ALTER TABLE RecommendationTable 
          ADD CONSTRAINT fkKodeBukuPertama FOREIGN KEY (kodeBukuPertama) REFERENCES KumpulanBuku(idBuku),
          ADD CONSTRAINT fkKodeBukuKedua FOREIGN KEY (kodeBukuKedua) REFERENCES KumpulanBuku(idBuku)
      '
    );

    $sql = "CREATE PROCEDURE MakeRecommendation()
            BEGIN
            DECLARE transval varchar(100);
            DECLARE spval int ;
            DECLARE SupportTransaksiMengandungTransPertama INT ;
            DECLARE SupportTransaksiMengandungTransPertamaDanKedua INT;
            DECLARE isfinished int;
            DECLARE endval int;
            DECLARE kodeBukuPertamaChar varchar(100);
            DECLARE kodeBukuKeduaChar varchar(100);
            DECLARE kodeBukuPertama int;
            DECLARE kodeBukuKedua int;
            DECLARE trans_cursor CURSOR FOR SELECT transaksi,sp FROM recommendationTemp;
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET isfinished =  1;
            CREATE TABLE recommendationTemp(
              transaksi varchar(100),
              sp int
            );
            CREATE TABLE SupportUser(
              idUser int
            );
            
            INSERT INTO recommendationTemp
            SELECT
              tableresult.transaksi,
              COUNT(tableresult.transaksi) as support2
            FROM 
            (
              SELECT t3.idUser,CONCAT(t3.idBuku,',',table4.idBuku) as transaksi
              FROM 
              (
                 SELECT 
                  kumpulanpeminjaman.idUser,
                  kumpulaneksemplar.idBuku 
                 FROM 
                  kumpulanpeminjaman
                 INNER JOIN 
                  kumpulaneksemplar on kumpulanpeminjaman.kodeEksemplar = kumpulaneksemplar.kodeEksemplar
              ) as t3
              INNER JOIN 
              (
                SELECT 
                  kumpulanpeminjaman.idUser,
                  kumpulaneksemplar.idBuku 
                FROM 
                  kumpulanpeminjaman
                INNER JOIN 
                  kumpulaneksemplar on kumpulanpeminjaman.kodeEksemplar = kumpulaneksemplar.kodeEksemplar
              ) as table4 ON table4.idUser = t3.idUser AND table4.idBUku != t3.idBuku
            ) as tableresult
            GROUP BY 
              tableresult.transaksi
            HAVING
              support2 >= 3 
            ORDER BY
              support2 DESC;
            SET isfinished = 0 ;
            DELETE FROM RecommendationTable;
            OPEN trans_cursor;
            get_trans: LOOP 
              FETCH trans_cursor INTO transval,spval;
                IF isfinished = 1 THEN 
                LEAVE get_trans;
                END IF;
                SELECT INSTR(transval,',') INTO endval;
                SELECT SUBSTRING(transval,1,(endval-1)) INTO kodeBukuPertamaChar ;
                SELECT SUBSTRING(transval,(endval+1),100) INTO kodeBukuKeduaChar ;
                
                SELECT CONVERT(kodeBukuPertamaChar,SIGNED) INTO kodeBukuPertama;
                SELECT CONVERT(kodeBukuKeduaChar,SIGNED) INTO kodeBukuKedua;


                INSERT INTO SupportUser
                SELECT DISTINCT idUser
                FROM KumpulanPeminjaman
                INNER JOIN KumpulanEksemplar on KumpulanEksemplar.kodeEksemplar =  KumpulanPeminjaman.kodeEksemplar
                WHERE KumpulanEksemplar.idBuku = kodeBukuPertama;

                SELECT COUNT(idUser) INTO SupportTransaksiMengandungTransPertama
                FROM SupportUser;

                SELECT COUNT(DISTINCT SupportUser.idUser) INTO SupportTransaksiMengandungTransPertamaDanKedua-- hitung yang berbeda saja
                FROM SupportUser
                INNER JOIN KumpulanPeminjaman on KumpulanPeminjaman.idUser = SupportUser.idUser
                INNER JOIN KumpulanEksemplar on KumpulanEksemplar.kodeEksemplar =  KumpulanPeminjaman.kodeEksemplar
                WHERE KumpulanEksemplar.idBuku = kodeBukuKedua;

                INSERT INTO RecommendationTable(kodeBukuPertama,kodeBukuKedua,support)
                VALUES (kodeBukuPertama,
                        kodeBukuKedua,
                        SupportTransaksiMengandungTransPertamaDanKedua*1.0/SupportTransaksiMengandungTransPertama);

                DELETE FROM SupportUser;
              END LOOP get_trans;
              DROP TABLE SupportUser;
              DROP TABLE recommendationTemp;
            CLOSE trans_cursor;
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
    DB::statement(
      'ALTER TABLE RecommendationTable 
          DROP FOREIGN KEY fkKodeBukuPertama,
          DROP FOREIGN KEY fkKodeBukuKedua
      '
    );
    DB::statement("DROP TABLE IF EXISTS RecommendationTable");
    DB::unprepared("DROP PROCEDURE IF EXISTS MakeRecommendation");
  }
}
