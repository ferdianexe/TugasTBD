<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateShowPeminjamanWithOffset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowPeminjamanWithOffset (
            IN all_param int,
            IN page_param INT
            )
        BEGIN
            DECLARE offset_val INT ;
            SET offset_val = page_param*10;
            IF all_param = 0 THEN
            SELECT 
            users.id as idUser,users.name AS namaUser,tglJatuhTempo,KumpulanBuku.nama,KumpulanEksemplar.kodeEksemplar,totalDenda,tanggalMeminjam,tanggalDibalikan,hasReturned
            FROM 
                KumpulanPeminjaman
            INNER JOIN KumpulanEksemplar ON KumpulanEksemplar.kodeEksemplar = KumpulanPeminjaman.kodeEksemplar
            INNER JOIN KumpulanBuku ON KumpulanBuku.idBuku = KumpulanEksemplar.idBuku
            INNER JOIN users ON users.id = KumpulanPeminjaman.idUser
            ORDER BY tanggalMeminjam desc
            LIMIT offset_val,10;
            ELSE
            SELECT 
            users.name AS namaUser,tglJatuhTempo,KumpulanBuku.nama,KumpulanEksemplar.kodeEksemplar,totalDenda,tanggalMeminjam,tanggalDibalikan,hasReturned
            FROM 
                KumpulanPeminjaman
            INNER JOIN KumpulanEksemplar ON KumpulanEksemplar.kodeEksemplar = KumpulanPeminjaman.kodeEksemplar
            INNER JOIN KumpulanBuku ON KumpulanBuku.idBuku = KumpulanEksemplar.idBuku
            INNER JOIN users ON users.id = KumpulanPeminjaman.idUser
            WHERE users.id = all_param
            ORDER BY tanggalMeminjam desc
            LIMIT offset_val,10;
            END IF;
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
        DB::unprepared("DROP PROCEDURE IF EXISTS ShowPeminjamanWithOffset");
    }
}
