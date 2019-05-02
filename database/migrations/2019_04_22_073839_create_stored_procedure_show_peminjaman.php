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
            users.id as idUser,users.name AS namaUser,tglJatuhTempo,KumpulanBuku.nama,KumpulanEksemplar.kodeEksemplar,totalDenda,tanggalMeminjam,hasReturned
            FROM 
                KumpulanPeminjaman
            INNER JOIN KumpulanEksemplar ON KumpulanEksemplar.kodeEksemplar = KumpulanPeminjaman.kodeEksemplar
            INNER JOIN KumpulanBuku ON KumpulanBuku.idBuku = KumpulanEksemplar.idBuku
            INNER JOIN users ON users.id = KumpulanPeminjaman.idUser;
            ELSE
            SELECT 
            users.name AS namaUser,tglJatuhTempo,KumpulanBuku.nama,KumpulanEksemplar.kodeEksemplar,totalDenda,tanggalMeminjam,hasReturned
            FROM 
                KumpulanPeminjaman
            INNER JOIN KumpulanEksemplar ON KumpulanEksemplar.kodeEksemplar = KumpulanPeminjaman.kodeEksemplar
            INNER JOIN KumpulanBuku ON KumpulanBuku.idBuku = KumpulanEksemplar.idBuku
            INNER JOIN users ON users.id = KumpulanPeminjaman.idUser
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
