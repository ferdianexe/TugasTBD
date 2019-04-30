<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureBukuTerfavorite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowBukuTerfavorite()
        BEGIN
           SELECT 
                KumpulanBuku.nama, count(temp.idPeminjaman) as jumlahPeminjaman
            FROM
                KumpulanBuku
                INNER JOIN 
                ( SELECT KumpulanPeminjaman.idPeminjaman, KumpulanEksemplar.idBuku
                  FROM
                      KumpulanPeminjaman 
                      INNER JOIN KumpulanEksemplar ON KumpulanPeminjaman.kodeEksemplar = KumpulanEksemplar.kodeEksemplar) AS temp
                ON KumpulanBuku.idBuku = temp.idBuku
            GROUP BY
                KumpulanBuku.nama
            ORDER BY jumlahPeminjaman DESC;
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
            "DROP PROCEDURE ShowBukuTerfavorite"
        );
    }
}
