<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          //TODO : Add Constraint in new Migration 
          DB::statement(
            'ALTER TABLE kumpulankatadanbuku 
                ADD CONSTRAINT fkBukuKumpulanBuku FOREIGN KEY (idBuku) REFERENCES kumpulanbuku(idBuku),
                ADD CONSTRAINT fkKataBukuKumpulanBuku FOREIGN KEY (kata) REFERENCES KumpulanKata(kata)
            '
          );
          //TODO : constraint fkBukuKumpulanBuku idBuku  -> Buku.idBuku
          //TODO : constraint fkKataBukuKumpulanBuku kata  -> KumpulanKata.kata

          DB::statement(
            'ALTER TABLE KumpulanBuku 
                ADD CONSTRAINT fkBukuKePenerbit FOREIGN KEY (idPenerbit) REFERENCES KumpulanPenerbit(idPenerbit),
                ADD CONSTRAINT fkBukukePengarang FOREIGN KEY (idPengarang) REFERENCES KumpulanPengarang(idPengarang)
            '
          );
          //TODO : constraint fkBukuKePenerbit idPenerbit  -> Penerbit.idPenerbit
          //TODO : constraint fkBukukePengarang idPengarang  -> Pengarang.idPengarang
        
          DB::statement(
            'ALTER TABLE KumpulanBukudanKumpulanKategori 
                ADD CONSTRAINT fkBukuKeKategori FOREIGN KEY (idBuku) REFERENCES KumpulanBuku(idBuku),
                ADD CONSTRAINT fkKategorikeKategori FOREIGN KEY (idKategori) REFERENCES KumpulanKategori(idKategori)
            '
          );
          //TODO : constraint fkBukuKeKategori idBuku  -> Buku.idBuku
          //TODO : constraint fkKategorikeKategori idKategori  -> Kategori.idKategori

          DB::statement(
            'ALTER TABLE KumpulanEksemplar
                ADD CONSTRAINT fkBukuKeEksemplar FOREIGN KEY (idBuku) REFERENCES KumpulanBuku(idBuku)
            '
          );
          //TODO : constraint fkBukuKeEksemplar idBuku  -> Buku.idBuku
        
          DB::statement(
            'ALTER TABLE KumpulanPemesanan
                -- constraint fkUsers foreign key (fkUsers) references Users(idUser),
	            -- constraint fkEksemplar foreign key (fkEksemplar) references Eksemplar(kodeEks)
                ADD CONSTRAINT fkBukuKePemesanan FOREIGN KEY (idBuku) REFERENCES KumpulanBuku(idBuku),
                ADD CONSTRAINT fkUserKeEksemplar FOREIGN KEY (idUser) REFERENCES users(id)
            '
          );
          //TODO : constraint fkBukuKePemesanan idBuku  -> Buku.idBuku
          //TODO : constraint fkUserKeEksemplar idUser  -> User.idUser

          DB::statement(
            'ALTER TABLE KumpulanPeminjaman
                ADD CONSTRAINT fkEksemplarKePeminjaman FOREIGN KEY (kodeEksemplar) REFERENCES KumpulanEksemplar(kodeEksemplar),
                ADD CONSTRAINT fkUserKePeminjaman FOREIGN KEY (idUser) REFERENCES users(id),
                ADD CONSTRAINT fkDendaPeminjaman FOREIGN KEY (fkDenda) REFERENCES AturanDenda(hariKe)
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
