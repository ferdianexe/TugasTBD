<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShowStoredProcedureDendaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowDendaKu (
            IN idUser int
        )
        BEGIN
            -- info yang akan diberikan
            -- (namaBuku, tglMinjam, tglJatuhTempo, totalDenda)
            SELECT
                tanggalMeminjam,tglJatuhTempo
            FROM 
                kumpulanpeminjaman 
                inner join users on kumpulanpeminjaman.idUser = users.id
            WHERE
                users.id = idUser;
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
        DB::unprepared("DROP PROCEDURE ShowDendaKu");
    }
}
