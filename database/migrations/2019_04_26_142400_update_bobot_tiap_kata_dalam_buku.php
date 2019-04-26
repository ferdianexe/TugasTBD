<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateBobotTiapKataDalamBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("ALTER TABLE kumpulankatadanbuku ADD BobotTiapKataDalamBuku FLOAT NOT NULL DEFAULT 0 AFTER idBuku");

      $sql = "CREATE PROCEDURE updateBobot()
        BEGIN
            UPDATE kumpulankatadanbuku
            INNER JOIN kumpulankata ON kumpulankata.kata = kumpulankatadanbuku.kata
            SET kumpulankatadanbuku.BobotTiapKataDalamBuku = (1+LOG(2,kumpulankatadanbuku.kemunculankata))*kumpulankata.nilaiKata;
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
      DB::statement("ALTER TABLE kumpulankatadanbuku DROP BobotTiapKataDalamBuku");
      DB::unprepared("DROP PROCEDURE updateBobot");
    }
}
