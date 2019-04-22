<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStroredProcedureShowBukudanEksemplar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowBukudanEksemplar (IN id_param int)
        BEGIN
            SELECT kumpulanbuku.nama,kumpulanbuku.idBuku,kumpulanbuku.tebalBuku,kumpulanbuku.tahunTerbit,kumpulanbuku.hargaBuku,kumpulanpenerbit.namaPenerbit,kumpulanpengarang.namaPengarang
            FROM kumpulanbuku 
            INNER JOIN kumpulaneksemplar ON kumpulanbuku.idBuku = kumpulaneksemplar.idBuku
            INNER JOIN kumpulanpenerbit ON kumpulanbuku.idPenerbit = kumpulanpenerbit.idPenerbit
            INNER JOIN kumpulanpengarang ON kumpulanbuku.idPengarang = kumpulanpengarang.idPengarang
            WHERE kumpulanbuku.idBuku = id_param ;
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
            "DROP PROCEDURE ShowBukudanEksemplar"
          );
    }
}
