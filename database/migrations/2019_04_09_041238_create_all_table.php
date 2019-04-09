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
    //TODO : Add Constraint in new Migration 
    DB::statement(
      'CREATE TABLE KumpulanKatadanBuku
        (
          kata varchar(50),
          idBuku int
        )'
    );
    //TODO : constraint fkBukuKumpulanBuku idBuku  -> Buku.idBuku
    //TODO : constraint fkKataBukuKumpulanBuku kata  -> KumpulanKata.kata
    DB::statement(
      'CREATE TABLE KumpulanBuku
          (
            nama varchar(50),
            idBuku int,
            tebalBuku int,
            tahunTerbit int,
            hargaBuku decimal(15,2),
            idPenerbit int,
            idPengarang int,
            primary key(idBuku)
          )
        '
    );
    //TODO : constraint fkBukuKePenerbit idPenerbit  -> Penerbit.idPenerbit
    //TODO : constraint fkBukukePengarang idPengarang  -> Pengarang.idPengarang
    DB::statement(
      'CREATE TABLE KumpulanPenerbit
          (
            namaPenerbit varchar(50),
            idPenerbit int,
            primary key(idPenerbit)
          )
        '
    );
    DB::statement(
      'CREATE TABLE KumpulanPengarang
        (
          namaPengarang varchar(50),
          idPengarang int,
          primary key(idPengarang)
        )
      '
    );
    DB::statement(
      'CREATE TABLE KumpulanKategori
        (
          Kategori varchar(50),
          idKategori int,
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
    //TODO : constraint fkBukuKeKategori idBuku  -> Buku.idBuku
    //TODO : constraint fkKategorikeKategori idKategori  -> Kategori.idKategori
    DB::statement(
      'CREATE TABLE KumpulanEksemplar
        (
          kodeEksemplar int,
          idBuku int,
          statusPeminjaman tinyint,
          primary key(kodeEksemplar)
        )
      '
    );
    //TODO : constraint fkBukuKeEksemplar idBuku  -> Buku.idBuku
    DB::statement(
      'CREATE TABLE AturanDenda
        (
          nominalDenda decimal(15,2),
          hariKe int,
          primary key(hariKe)
        )
      '
    );
    DB::statement(
      'CREATE TABLE KumpulanPemesanan
        (
          idPemesanan int,
          antrianKe int,
          idBuku int,
          idUser int,
          primary key(idPemesanan)
        )
      '
    );
    //TODO : constraint fkBukuKePemesanan idBuku  -> Buku.idBuku
    //TODO : constraint fkUserKeEksemplar idUser  -> User.idUser
    DB::statement(
      'CREATE TABLE KumpulanPeminjaman
        (
          idPeminjaman int,
          idUser int,
          tglJatuhTempo date,
          kodeEksemplar int,
          totalDenda decimal(15,2),
          fkDenda int,
          primary key(idPeminjaman)
        )
      '
    );
    //TODO : constraint fkEksemplarKePeminjaman idBuku  -> KumpulanEksemplar.kodeEksemplar
    //TODO : constraint fkUserKePeminjaman idUser  -> Users.idUser
    //TODO : constraint fkDendaPeminjaman fkDenda  -> Denda.hariKe
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
