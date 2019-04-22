<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateProcedureReadForPengarangPenerbitKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowAllPengarang ()
        BEGIN
            SELECT namaPengarang
            FROM kumpulanPengarang ;
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE ShowAllPenerbit ()
        BEGIN
            SELECT namaPenerbit
            FROM kumpulanPenerbit;
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE ShowAllCategory ()
        BEGIN
            SELECT kategori
            FROM kumpulankategori;
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
            "DROP PROCEDURE ShowAllCategory"
          );
        DB::unprepared(
            "DROP PROCEDURE ShowAllPenerbit"
        );
        DB::unprepared(
            "DROP PROCEDURE ShowAllPengarang"
        );
    }
}
