<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStoredProcedureShowPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowPeminjaman ()
        BEGIN
            SELECT 
                idUser,tglJatuhTempo,kumpulanBuku.nama,kumpulanEksemplar.kodeEksemplar,totalDenda 
            FROM 
                kumpulanPeminjaman
            INNER JOIN kumpulanEksemplar ON kumpulanEksemplar.kodeEksemplar = kumpulanPeminjaman.kodeEksemplar
            INNER JOIN kumpulanBuku ON KumpulanBuku.idBuku = kumpulanEksemplar.idBuku;
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
