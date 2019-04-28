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
                ADD tanggalMemesan DATE NULL DEFAULT NULL AFTER idUser'
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
                
                OPEN masukanUserDanTglTerakhir;

                -- FETCHING 
                get_all: LOOP
                    FETCH masukanUserDanTglTerakhir 
                    INTO tempIdUser;
                    
                    IF v_finished = 1 THEN 
                        LEAVE get_all;
                    END IF;
                    
                    -- SELECT idUser,kodeEksemplar, tanggalMeminjam,statusPeminjaman
                    -- FROM 
                    -- (
                    --     select top 1 idUser,kodeEksemplar, tanggalMeminjam
                    --     from kumpulanPeminjaman
                    --     where
                    --         idUser = tempIdUser
                    --     order by
                    --         tanggalMeminjam desc
                    -- ) as table1
                    -- INNER JOIN kumpulanEksemplar ON table1.kodeEksemplar = kumpulanEksemplar.kodeEksemplar;

                    -- SET/masukin nilai yang di fetch tadi ke table temp (utk tambah 1 record baru)
                    insert into userDanPinjamanTerakhir
                        select top 1 idUser, tanggalMeminjam
                        from kumpulanpeminjaman
                        where idUser = tempIdUser
                        order by tanggalMeminjam desc;
                    
                    insert into userDanPemesananTerakhir
                        select top 1 idUser, tanggalMemesan
                        from kumpulanpemesanan
                        where idUser = tempIdUser
                        order by idPemesanan desc;

                    insert into userDanStatusSudahDikembalikan
                        select top 1 idUser, hasReturned
                        from kumpulanpeminjaman
                        where idUser = tempIdUser
                        order by tglJatuhTempo desc;

                END LOOP get_all;
                -- END FETCHING

                CLOSE masukanUserDanTglTerakhir;
                -- End Cursor

            -- info yang akan diberikan
            SELECT
                id, name, statusAktif, terakhirMeminjam, terakhirMemesan, hasReturned
            FROM
                users
                inner join userDanPinjamanTerakhir on users.id = userDanPinjamanTerakhir.idUser
                inner join userDanPemesananTerakhir on users.id = userDanPemesananTerakhir.idUser
                inner join userDanStatusSudahDikembalikan on users.id = userDanStatusSudahDikembalikan.idUser;
            DROP table userDanPinjamanTerakhir;
            DROP table userDanPemesananTerakhir;
            DROP table userDanStatusSudahDikembalikan;
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
