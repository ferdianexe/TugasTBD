<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            'CREATE TABLE users (name varchar(50), id int not null AUTO_INCREMENT, statusAktif int, tglLahir date,
             tglGabung date, alamat varchar(50), username varchar(20), email varchar(50), password varchar(255), created_at date,
             updated_at date, primary key (id))'
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
            'DROP TABLE users'
        );
    }
}
