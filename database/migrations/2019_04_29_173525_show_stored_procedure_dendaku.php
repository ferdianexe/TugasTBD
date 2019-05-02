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
            IN inputIdUser int
        )
        BEGIN

            SELECT 
                kumpulanbuku.nama as namaBuku, kumpulanpeminjaman.tanggalMeminjam, kumpulanpeminjaman.tglJatuhTempo, kumpulanpeminjaman.totalDenda
            FROM
                kumpulanpeminjaman
                inner join kumpulaneksemplar on kumpulaneksemplar.kodeEksemplar = kumpulanpeminjaman.kodeEksemplar
                inner join kumpulanbuku on kumpulanbuku.idBuku = kumpulaneksemplar.idBuku
            WHERE
                kumpulanpeminjaman.idUser = inputIdUser and hasReturned = 1;
            
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
