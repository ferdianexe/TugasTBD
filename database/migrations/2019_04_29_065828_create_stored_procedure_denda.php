<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureDenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE CreateAturanDenda 
        (
            IN hari_Ke int,
            IN nominal_Denda decimal
        )
        BEGIN
            INSERT INTO aturandenda (hariKe,nominalDenda) VALUES (hari_Ke,nominal_Denda);
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
        DB::unprepared("DROP PROCEDURE CreateAturanDenda");
    }
}
