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

        SELECT
            id,name,statusAktif,tglLahir,tglGabung,alamat,email,terakhirMeminjam,terakhirMemesan,hasReturned
        FROM
            users;

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
