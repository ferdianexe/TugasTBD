<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class StoredProcedurePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql ="CREATE PROCEDURE tambahPeminjaman(
            IN iduser_param INT,
            IN tglJatuhTempo_param DATE,
            IN kodeEksemplar_param INT,
            IN tanggalMeminjam_param DATE,
            IN statusPengembalian_param INT
        )
        BEGIN
            INSERT INTO KumpulanPeminjaman(idUser,tglJatuhTempo,kodeEksemplar,totalDenda,fkDenda,tanggalMeminjam,hasReturned)
            VALUES (iduser_param,tglJatuhTempo_param,kodeEksemplar_param,0,NULL,tanggalMeminjam_param,statusPengembalian_param);
            UPDATE KumpulanEksemplar SET statusPeminjaman = 1 WHERE kumpulaneksemplar.kodeEksemplar = kodeEksemplar_param;
        END
        ";
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS tambahPeminjaman');
    }
}
