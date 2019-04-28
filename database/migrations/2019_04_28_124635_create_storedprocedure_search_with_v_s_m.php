<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateStoredprocedureSearchWithVSM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $sql ="CREATE PROCEDURE VsmSearch
      (
        IN query_param varchar(250)
      )
      BEGIN
        -- ide : pecahin kata katanya querynya, cari vectornya querynya, cari buku2 yang mengandung kata query
        -- dapat kan panjang vector dokumen, cari hasil kata yang mucnul di vector dokumen dan query , bagi hasilnya 
        -- order menurun lalu munculkan bukunya
        DECLARE start_val INT; -- Posisi awal diambil startnya dari query
        DECLARE end_val INT; -- posisi huruf terakhir yang mau dipecah dari search query
        DECLARE curcat_val varchar(250); -- kata sekarang
        DECLARE query_current_val varchar(250); -- kata kata yang nantinya akan dipecah
        DECLARE panjang_vector_query_val float ; -- hasil penjumlahhan akar dari table vector query
        CREATE TABLE pecahanKata(kataQuery varchar(250)); -- temp table kumpulan query pencarian
        CREATE TABLE pecahanKataDenganCounter(kataQuery varchar(250),totalKemunculan int); -- temp table untuk pecahan kata dan pencariannya
        CREATE TABLE vectorQuery(kataQuery varchar(250),bobot FLOAT,bobotkuadrat FLOAT); -- vector query
        CREATE TABLE vectorDocument(idBuku int,nilai FLOAT); -- panjang vector document tiap buku
        CREATE TABLE bukuTerpilih(idBuku int); -- buku buku yang mengandung kata dalam query
        CREATE TABLE nilaiKataDokumentDanQuery(idBuku int,nilai FLOAT); -- hasil operasi perkalian dan penjumlahan antara kata yang terdapat di document juga di query tersebut
        SET query_current_val = (SELECT LOWER(query_param)); -- jadikan semuanya huruf kecil dulu, karena kumpulan katanya huruf kecil
        SET start_val = 1 ;
       
        WHILE start_val != 0  DO -- selama masih ada kata yang dipecah masuk looping
          SELECT INSTR(query_current_val,' ') INTO end_val ;-- dapatkan value terakhirnya
          IF end_val = 0 THEN -- tinggal satu kata
            SET end_val = 500 ;
            SELECT SUBSTRING(query_current_val,start_val,end_val) INTO curcat_val;
            SET start_val = 0 ; -- biar keluar looping
          ELSE -- artinya masih bisa dipecah
            SELECT SUBSTRING(query_current_val,start_val,end_val) INTO curcat_val;
            SELECT SUBSTRING(query_current_val,(end_val+1),300) INTO query_current_val; -- update stringnya
          END IF ;
          INSERT INTO pecahanKata -- dimasukan kedalam table pecahan kata
          SELECT curcat_val;
        END WHILE;
        -- query untuk mendapatkanya banyak kemunculan tiap kata di query pencarian
        INSERT INTO pecahanKataDenganCounter(kataQuery,totalKemunculan)
        SELECT kataQuery,count(kataQuery) -- hitung banyak katanya
        FROM pecahankata
        GROUP BY kataQuery; -- grup tiap kata

        -- query untuk mendapatkan bobot ^2 dalam kata query
        INSERT INTO vectorQuery
        SELECT 
          kataQuery,
          (LOG(2,totalKemunculan)+1)*kumpulanKata.nilaiKata, -- bobot awal biar bisa dipake lagi
          POW(((LOG(2,totalKemunculan)+1)*kumpulanKata.nilaiKata),2) -- bobot^2
        FROM 
          pecahanKataDenganCounter
        INNER JOIN 
          kumpulankata ON kumpulankata.kata = pecahanKataDenganCounter.kataQuery;

        -- query untuk memasukan buku buku yang terdapat katanya di query pencarian
        INSERT INTO 
          bukuTerpilih
        SELECT DISTINCT -- cuman perlu IDnya saja
          idBuku
        FROM 
          KumpulanKatadanBuku
        INNER JOIN 
          vectorQuery on vectorQuery.kataQuery = KumpulanKatadanBuku.kata;

        -- query untuk mendapatkan panjang vector document tiap buku
        INSERT INTO 
          vectorDocument
        SELECT 
          idBuku, 
          SQRT(SUM(bobot)) -- jumlahkan lalu bagi sesuai rumus eucledian
        FROM 
        (
          SELECT 
            KumpulanKataDanBuku.kata,
            KumpulanKataDanBuku.idBuku,
            bobottiapkatadalambuku*bobottiapkatadalambuku as bobot
          FROM 
            KumpulanKataDanBuku
          INNER JOIN 
            bukuTerpilih ON bukuTerpilih.idBuku = KumpulanKataDanBuku.idBuku
        ) as tableBobot
        GROUP BY 
          idBuku;
        
        -- query untuk memasukan panjang vector query
        SELECT 
          SQRT(SUM(bobotkuadrat)) INTO panjang_vector_query_val
        FROM 
          vectorQuery;

        -- query untuk menghitung kata kata yang muncul tepat dengan query pencarian dan dimasukan ke table penampung
        INSERT INTO 
          nilaiKataDokumentDanQuery
        SELECT 
          thasil.idBuku,SUM(totalBobot)
        FROM
          (
            SELECT 
              KumpulanKataDanBuku.idBuku,
              KumpulanKataDanBuku.bobottiapkatadalambuku*vectorquery.bobot as totalBobot
            FROM 
              bukuTerpilih
            INNER JOIN 
              KumpulanKataDanBuku ON KumpulanKataDanBuku.idBuku = bukuterpilih.idBuku
            INNER JOIN 
              vectorquery ON kumpulankatadanbuku.kata = vectorquery.kataQuery
          ) as thasil
        GROUP BY 
          thasil.idBuku;
        
        -- query perhitungan akhir mengeluarkan result tertinggi
        SELECT 
          kumpulanBuku.nama,nilaiKataDokumentDanQuery.idBuku,nilaiKataDokumentDanQuery.nilai/(vectorDocument.nilai+panjang_vector_query_val) as VSMvalue
        FROM 
          nilaiKataDokumentDanQuery
        INNER JOIN 
          vectorDocument ON vectorDocument.idBuku = nilaiKataDokumentDanQuery.idBuku
        INNER JOIN
          kumpulanBuku ON nilaiKataDokumentDanQuery.idBuku = kumpulanBuku.idBuku
        ORDER BY
          VSMValue DESC;

        DROP TABLE nilaiKataDokumentDanQuery;
        DROP TABLE vectorDocument;
        DROP TABLE bukuTerpilih;
        DROP TABLE vectorQuery;
        DROP TABLE pecahanKata; -- drop tablenya
        DROP TABLE pecahanKataDenganCounter;
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
      DB::unprepared("DROP PROCEDURE VsmSearch");
    }
}
