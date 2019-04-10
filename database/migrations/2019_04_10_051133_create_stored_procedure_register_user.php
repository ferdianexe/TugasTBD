<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedureRegisterUser extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sql = "CREATE PROCEDURE RegisterUser 
       (IN name_param varchar(50),
        IN status_aktif_param int,
        IN tgl_lahir_param date,
        IN tgl_gabung_param date,
        IN alamat_param varchar(50),
        IN username_param varchar(50),
        IN email_param varchar(50),
        IN password_param varchar(255),
        IN create_at_param date,
        IN updated_at_param date
       )
       BEGIN
        INSERT INTO users(name,statusAktif,tglLahir,tglGabung,alamat,username,email,password,created_at,updated_at)
        VALUES (name_param,status_aktif_param,tgl_lahir_param,tgl_gabung_param,alamat_param,username_param,email_param,password_param,create_at_param,updated_at_param);
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
      "DROP PROCEDURE RegisterUser"
    );
  }
}
