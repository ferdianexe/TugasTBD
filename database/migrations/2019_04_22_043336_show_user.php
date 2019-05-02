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
            'ALTER TABLE KumpulanPeminjaman 
                ADD hasReturned INT NOT NULL DEFAULT 0 AFTER fkDenda'
        );
        DB::statement(
            'ALTER TABLE KumpulanPemesanan 
                ADD tanggalMemesan DATE NULL DEFAULT NULL AFTER idUser'
        );

        $sql = "CREATE PROCEDURE ShowUser ()
        BEGIN
            DECLARE tempIdUser INT;
            DECLARE v_finished int;
                
                -- Cursor
                DECLARE masukanUserDanTglTerakhir CURSOR FOR 
                SELECT id From users;
                
                -- declare NOT FOUND handler
                DECLARE CONTINUE HANDLER 
                        FOR NOT FOUND SET v_finished = 1;

                CREATE TABLE userDanPinjamanTerakhir(
                    idUser int,
                    terakhirMeminjam timestamp
                );
                CREATE TABLE userDanPemesananTerakhir(
                    idUser int,
                    terakhirMemesan timestamp
                );
                CREATE TABLE userDanStatusSudahDikembalikan(
                    idUser int,
                    hasReturned int
                );
                CREATE TABLE tempHasil(
                    idUser int,
                    terakhirMeminjam timestamp,
                    terakhirMemesan timestamp,
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

                    insert into userDanPinjamanTerakhir (idUser,terakhirMeminjam)
                        select idUser, tanggalMeminjam
                        from kumpulanpeminjaman
                        where idUser = tempIdUser
                        order by tanggalMeminjam desc
                        LIMIT 1;
                    
                    insert into userDanPemesananTerakhir (idUser,terakhirMemesan)
                        select idUser, tanggalMemesan
                        from kumpulanpemesanan
                        where idUser = tempIdUser
                        order by idPemesanan desc
                        LIMIT 1;

                    insert into userDanStatusSudahDikembalikan (idUser,hasReturned)
                        select idUser, hasReturned
                        from kumpulanpeminjaman
                        where idUser = tempIdUser
                        order by tglJatuhTempo desc
                        LIMIT 1;

                END LOOP get_all;
                -- END FETCHING

                -- Harusnya matiin kursor disini

            insert into tempHasil (idUser,terakhirMeminjam,terakhirMemesan,hasReturned)
                    select userDanPinjamanTerakhir.idUser,terakhirMeminjam,terakhirMemesan, hasReturned
                    from userDanPinjamanTerakhir
                        inner join userDanStatusSudahDikembalikan on userDanStatusSudahDikembalikan.idUser = userDanPinjamanTerakhir.idUser
                        left outer join userDanPemesananTerakhir on userDanPemesananTerakhir.idUser = userDanPinjamanTerakhir.idUser;

            SELECT 
                users.id, users.name, statusAktif, terakhirMeminjam, terakhirMemesan, hasReturned
            FROM users
                left outer join tempHasil on users.id = tempHasil.idUser;

            DROP table userDanPinjamanTerakhir;
            DROP table userDanPemesananTerakhir;
            DROP table userDanStatusSudahDikembalikan;
            DROP table tempHasil;
            -- End Cursor
            CLOSE masukanUserDanTglTerakhir;
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

        DB::unprepared(
            'ALTER TABLE kumpulanpemesanan 
                DROP tanggalMemesan'
        );

        DB::unprepared(
            'ALTER TABLE kumpulanpeminjaman 
                DROP hasReturned'
        );
    }
}
