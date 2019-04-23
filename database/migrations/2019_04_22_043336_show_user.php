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
            'ALTER TABLE users 
                ADD terakhirMeminjam DATE NULL DEFAULT NULL AFTER hakStatus,
                ADD terakhirMemesan DATE NULL DEFAULT NULL AFTER terakhirMeminjam,
                ADD hasReturned INT NOT NULL DEFAULT 0 AFTER terakhirMemesan'
        );

        $sql = "CREATE PROCEDURE ShowUser ()
        BEGIN
            DECLARE test INT;
            DECLARE res INT;
            SET test = 1;
            SET res = 0;

            CREATE TABLE userDanPinjamanTerakhir(
                id int,
                terakhirMemesan date
            );
            INSERT INTO userDanPinjamanTerakhir 
                SELECT DISTINCT id, tanggalMeminjam
                FROM users
                Group By id
                Order By tanggalMeminjam desc
            ;

                -- Cursor
                DECLARE namaCursor CURSOR FOR 
                SELECT id From users;

                -- declare NOT FOUND handler
                DECLARE CONTINUE HANDLER 
                        FOR NOT FOUND SET v_finished = 1;

                OPEN namaCursor;

                -- FETCHING 
                get_all_id: LOOP
                    FETCH namaCursor INTO test;
                    
                    IF v_finished = 1 THEN 
                        LEAVE get_all_id;
                    END IF;

                    -- SET/masukin nilai yang di fetch tadi ke table temp (utk tambah 1 record baru)
                    SET res = test; 
                END LOOP get_all_id;
                -- END FETCHING

                CLOSE namaCursor;
                -- End Cursor

            SELECT
                test,id,name,statusAktif,tglLahir,tglGabung,alamat,email,terakhirMeminjam,terakhirMemesan,hasReturned
            FROM
                users;
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
