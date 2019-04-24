<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShowUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            'ALTER TABLE kumpulanpeminjaman 
                ADD hasReturned INT NOT NULL DEFAULT 0 AFTER fkDenda'
        );
        DB::statement(
            'ALTER TABLE kumpulanpemesanan 
                ADD tanggalMemesan DATE NULL DEFAULT NULL AFTER tanggalMemesan'
        );

        $sql = "CREATE PROCEDURE ShowUser ()
        BEGIN
            DECLARE tempIdUser INT;
            DECLARE tempTglMeminjam INT;
            DECLARE tempTglMemesan INT;
            DECLARE tempHasReturned INT;
            DECLARE v_finished int;
                
                -- Cursor
                DECLARE masukanUserDanTglTerakhir CURSOR FOR 
                SELECT id From users;
                
                -- declare NOT FOUND handler
                DECLARE CONTINUE HANDLER 
                        FOR NOT FOUND SET v_finished = 1;

                CREATE TABLE userDanPinjamanTerakhir(
                    idUser int,
                    terakhirMeminjam date
                );
                CREATE TABLE userDanPesananTerakhir(
                    idUser int,
                    terakhirMemesan date
                );
                CREATE TABLE userDanStatusSudahDikembalikan(
                    idUser int,
                    hasReturned int
                );
                CREATE TABLE result(
                    idUser int,
                    terakhirMeminjam date,
                    terakhirMemesan date,
                    hasReturned int
                );

                OPEN masukanUserDanTglTerakhir;

                -- FETCHING 
                get_all: LOOP
                    FETCH masukanUserDanTglTerakhir 
                    INTO tempIdUser;
                    
                    IF v_finished = 1 THEN 
                        LEAVE get_all;
                    END IF;
                    
                    SELECT idUser,kodeEksemplar, tanggalMeminjam,statusPeminjaman
                    FROM (
                    select top 1 idUser,kodeEksemplar, tanggalMeminjam
                    from kumpulanPeminjaman
                    where
                        idUser = tempIdUser
                    order by
                        tanggalMeminjam desc
                        ) as table1
                    INNER JOIN kumpulanEksemplar ON table1.kodeEksemplar = kumpulanEksemplar.kodeEksemplar;

                    -- SET/masukin nilai yang di fetch tadi ke table temp (utk tambah 1 record baru)
                    insert into userDanPinjamanTerakhir
                        select top 1 idUser, tanggalMeminjam
                        from kumpulanpeminjaman
                        where idUser = tempIdUser
                        order by tanggalMeminjam desc;
                    
                    insert into userDanPemesananTerakhir
                        select top 1 idUser, tanggalMemesan
                        from kumpulanpeminjaman
                        where idUser = tempIdUser
                        order by tanggalMeminjam desc;

                END LOOP get_all;
                -- END FETCHING

                CLOSE masukanUserDanTglTerakhir;
                -- End Cursor

            SELECT
                test,id,name,statusAktif,tglLahir,tglGabung,alamat,email,terakhirMeminjam,terakhirMemesan,hasReturned
            FROM
                result;
            DROP table userDanPinjamanTerakhir;
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
            "DROP PROCEDURE ShowUser"
          );
    }
}
