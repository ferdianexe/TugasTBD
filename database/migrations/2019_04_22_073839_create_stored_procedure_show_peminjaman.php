<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStoredProcedureShowPeminjaman extends Migration
{
    /**
     * Run the migrations.
     * Show semua peminjaman selama all = 0
     * jika all != 0 maka yang dishow hanyalah per user saja berdasarkan id
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowPeminjaman (IN all_param int)
        BEGIN
            IF all_param = 0 THEN
            SELECT 
            users.name AS namaUser,tglJatuhTempo,kumpulanBuku.nama,kumpulanEksemplar.kodeEksemplar,totalDenda,tanggalMeminjam 
            FROM 
                kumpulanPeminjaman
            INNER JOIN kumpulanEksemplar ON kumpulanEksemplar.kodeEksemplar = kumpulanPeminjaman.kodeEksemplar
            INNER JOIN kumpulanBuku ON KumpulanBuku.idBuku = kumpulanEksemplar.idBuku
            INNER JOIN users ON users.id = kumpulanPeminjaman.idUser;
            ELSE
            SELECT 
            users.name AS namaUser,tglJatuhTempo,kumpulanBuku.nama,kumpulanEksemplar.kodeEksemplar,totalDenda,tanggalMeminjam 
            FROM 
                kumpulanPeminjaman
            INNER JOIN kumpulanEksemplar ON kumpulanEksemplar.kodeEksemplar = kumpulanPeminjaman.kodeEksemplar
            INNER JOIN kumpulanBuku ON KumpulanBuku.idBuku = kumpulanEksemplar.idBuku
            INNER JOIN users ON users.id = kumpulanPeminjaman.idUser
            WHERE users.id = all_param;
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
        DB::unprepared(
            "DROP PROCEDURE ShowPeminjaman"
          );
    }
}
