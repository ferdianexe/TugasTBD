<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateShowUserDetailProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $sql = "CREATE PROCEDURE detailUser (IN id_param int)
      BEGIN
          SELECT name,tglLahir,tglGabung, alamat,email,username
          FROM Users
          WHERE id = id_param
          LIMIT 1 ;
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
      DB::unprepared('DROP PROCEDURE IF EXISTS detailUser');
    }
}
