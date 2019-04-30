<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement(
      'CREATE TABLE KumpulanKata
        (
          kata varchar(50),
          nilaiKata float,
          primary key(kata)
        )'
    );

    DB::statement(
      'CREATE TABLE KumpulanKatadanBuku
        (
          kata varchar(50),
          idBuku int
        )'
    );
    
    DB::statement(
      'CREATE TABLE KumpulanBuku
          (
            nama varchar(255),
            idBuku int NOT NULL AUTO_INCREMENT,
            tebalBuku int,
            tahunTerbit int,
            hargaBuku decimal(15,2),
            idPenerbit int,
            idPengarang int,
            primary key(idBuku)
          )
        '
    );
    
    DB::statement(
      'CREATE TABLE KumpulanPenerbit
          (
            namaPenerbit varchar(50),
            idPenerbit int NOT NULL AUTO_INCREMENT,
            primary key(idPenerbit)
          )
        '
    );

    DB::statement(
      'CREATE TABLE KumpulanPengarang
        (
          namaPengarang varchar(50),
          idPengarang int NOT NULL AUTO_INCREMENT,
          primary key(idPengarang)
        )
      '
    );

    DB::statement(
      'CREATE TABLE KumpulanKategori
        (
          Kategori varchar(50),
          idKategori int NOT NULL AUTO_INCREMENT,
          primary key(idKategori)
        )
      '
    );

    DB::statement(
      'CREATE TABLE KumpulanBukudanKumpulanKategori
        (
          idBuku int,
          idKategori int
        )
      '
    );
    
    DB::statement(
      'CREATE TABLE KumpulanEksemplar
        (
          kodeEksemplar int NOT NULL AUTO_INCREMENT,
          idBuku int,
          statusPeminjaman tinyint,
          primary key(kodeEksemplar)
        )
      '
    );
    
    DB::statement(
      'CREATE TABLE AturanDenda
        (
          nominalDenda decimal(15,2),
          hariKe int NOT NULL AUTO_INCREMENT,
          primary key(hariKe)
        )
      '
    );

    DB::statement(
      'CREATE TABLE KumpulanPemesanan
        (
          idPemesanan int NOT NULL AUTO_INCREMENT,
          antrianKe int,
          idBuku int,
          idUser int,
          primary key(idPemesanan)
        )
      '
    );
    
    DB::statement(
      'CREATE TABLE KumpulanPeminjaman
        (
          idPeminjaman int NOT NULL AUTO_INCREMENT,
          idUser int,
          tglJatuhTempo date,
          kodeEksemplar int,
          totalDenda decimal(15,2),
          fkDenda int,
          primary key(idPeminjaman)
        )
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
    DB::statement('DROP TABLE KumpulanKata');
    DB::statement('DROP TABLE KumpulanKatadanBuku');
    DB::statement('DROP TABLE KumpulanBuku');
    DB::statement('DROP TABLE KumpulanPenerbit');
    DB::statement('DROP TABLE KumpulanPengarang');
    DB::statement('DROP TABLE KumpulanKategori');
    DB::statement('DROP TABLE KumpulanBukudanKumpulanKategori');
    DB::statement('DROP TABLE KumpulanEksemplar');
    DB::statement('DROP TABLE AturanDenda');
    DB::statement('DROP TABLE KumpulanPemesanan');
    DB::statement('DROP TABLE KumpulanPeminjaman');
  }
}
