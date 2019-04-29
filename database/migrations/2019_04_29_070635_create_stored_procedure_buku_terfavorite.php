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
           (SELECT 
                kumpulanbuku.nama, count(temp.idPeminjaman) as jumlahPeminjaman
            FROM
                kumpulanbuku
                INNER JOIN 
                ( SELECT kumpulanpeminjaman.idPeminjaman, kumpulaneksemplar.idBuku
                  FROM
                      kumpulanpeminjaman 
                      INNER JOIN kumpulaneksemplar ON kumpulanpeminjaman.kodeEksemplar = kumpulaneksemplar.kodeEksemplar) AS temp
                ON kumpulanbuku.idBuku = temp.idBuku
            GROUP BY
                kumpulanbuku.nama)->orderBy( 'jumlahPeminjaman','DESC')->get();
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
