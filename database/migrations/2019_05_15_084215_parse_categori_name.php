<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParseCategoriName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE giveCategoryName (
            IN categoryNumber INT
        )
        BEGIN
            -- info yang akan diberikan
            SELECT
                Kategori
            FROM
                kumpulankategori
            WHERE
                idKategori = categoryNumber;
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
        DB::unprepared("DROP PROCEDURE IF EXISTS giveCategoryName");
    }
}
