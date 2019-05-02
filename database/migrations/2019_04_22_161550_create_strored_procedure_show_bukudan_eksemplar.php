<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            SELECT KumpulanEksemplar.kodeEksemplar,statusPeminjaman
            FROM KumpulanEksemplar 
            WHERE idBuku = id_param ;
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE ShowBukuById (IN id_param int)
        BEGIN
            SELECT KumpulanBuku.nama,KumpulanBuku.idBuku,KumpulanBuku.tebalBuku,KumpulanBuku.tahunTerbit,KumpulanBuku.hargaBuku,kumpulanpenerbit.namaPenerbit,kumpulanpengarang.namaPengarang
            FROM KumpulanBuku
            INNER JOIN kumpulanpenerbit ON KumpulanBuku.idPenerbit = kumpulanpenerbit.idPenerbit
            INNER JOIN kumpulanpengarang ON KumpulanBuku.idPengarang = kumpulanpengarang.idPengarang
            WHERE KumpulanBuku.idBuku = id_param ;
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE ShowAllBukuOnlyIdAndJudul ()
        BEGIN
            SELECT nama,idBuku
            FROM KumpulanBuku;
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE ShowAllBukuOnlyIdAndJudulWithLimit (
            IN limit_param INT
        )
        BEGIN
            SELECT nama,idBuku
            FROM KumpulanBuku
            LIMIT limit_param;
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
            "DROP PROCEDURE IF EXISTS ShowBukudanEksemplar"
        );
        DB::unprepared(
            "DROP PROCEDURE IF EXISTS ShowBukuById"
        );
        DB::unprepared(
            "DROP PROCEDURE IF EXISTS ShowAllBukuOnlyIdAndJudul"
        );
        DB::unprepared(
            "DROP PROCEDURE IF EXISTS ShowAllBukuOnlyIdAndJudulWithLimit"
        );
    }
}
