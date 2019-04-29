<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoredProcedureDenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE UpdateAturanDenda
        (
            IN hari_ke int,
            IN nominal_denda decimal
        )
        BEGIN
            UPDATE aturandenda
            SET hariKe = hari_ke , nominalDenda = nominal_denda
            WHERE aturandenda.hariKe = hari_ke;
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
        DB::unprepared("DROP PROCEDURE UpdateAturanDenda");
    }
}
