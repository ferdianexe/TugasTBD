<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPengarangPenerbitKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE insertPengarang 
        (
            IN nama_pengarang varchar(50)
        )
        BEGIN
            INSERT INTO KumpulanPengarang (namaPengarang) VALUES (nama_pengarang);
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE insertPenerbit 
        (
            IN nama_penerbit varchar(50)
        )
        BEGIN
            INSERT INTO KumpulanPenerbit (namaPenerbit) VALUES (nama_penerbit);
        END";
        DB::connection()->getPdo()->exec($sql);

        $sql = "CREATE PROCEDURE insertKategori
        (
            IN nama_kategori varchar(50)
        )
        BEGIN
            INSERT INTO KumpulanKategori (Kategori) VALUES (LOWER(nama_kategori));
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
        DB::unprepared
        (
            "DROP PROCEDURE insertPengarang"
        );
        DB::unprepared
        (
            "DROP PROCEDURE insertPenerbit"
        );
        DB::unprepared
        (
            "DROP PROCEDURE insertKategori"
        );
    }
}
