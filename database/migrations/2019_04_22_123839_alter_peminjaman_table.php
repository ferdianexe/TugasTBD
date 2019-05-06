<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement(
        "ALTER TABLE 
          KumpulanPeminjaman 
          ADD tanggalMeminjam TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER fkDenda"
        );

        DB::statement(
          'ALTER TABLE kumpulanpeminjaman 
              ADD tanggalDibalikan TIMESTAMP NULL DEFAULT NULL AFTER tanggalMeminjam
          '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement(
        'ALTER TABLE 
          `KumpulanPeminjaman`
         DROP 
          `tanggalMeminjam`'
      );

      DB::statement(
        'ALTER TABLE kumpulanpeminjaman 
            DROP tanggalDibalikan
        '
      );
    }
}
