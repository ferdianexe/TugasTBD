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
          DB::statement(
            'ALTER TABLE kumpulankatadanbuku 
                ADD CONSTRAINT fkBukuKumpulanBuku FOREIGN KEY (idBuku) REFERENCES kumpulanbuku(idBuku),
                ADD CONSTRAINT fkKataBukuKumpulanBuku FOREIGN KEY (kata) REFERENCES KumpulanKata(kata)
            '
          );
         
          DB::statement(
            'ALTER TABLE KumpulanBuku 
                ADD CONSTRAINT fkBukuKePenerbit FOREIGN KEY (idPenerbit) REFERENCES KumpulanPenerbit(idPenerbit),
                ADD CONSTRAINT fkBukukePengarang FOREIGN KEY (idPengarang) REFERENCES KumpulanPengarang(idPengarang)
            '
          );
        
          DB::statement(
            'ALTER TABLE KumpulanBukudanKumpulanKategori 
                ADD CONSTRAINT fkBukuKeKategori FOREIGN KEY (idBuku) REFERENCES KumpulanBuku(idBuku),
                ADD CONSTRAINT fkKategorikeKategori FOREIGN KEY (idKategori) REFERENCES KumpulanKategori(idKategori)
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanEksemplar
                ADD CONSTRAINT fkBukuKeEksemplar FOREIGN KEY (idBuku) REFERENCES KumpulanBuku(idBuku)
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanPemesanan
                -- constraint fkUsers foreign key (fkUsers) references Users(idUser),
	            -- constraint fkEksemplar foreign key (fkEksemplar) references Eksemplar(kodeEks)
                ADD CONSTRAINT fkBukuKePemesanan FOREIGN KEY (idBuku) REFERENCES KumpulanBuku(idBuku),
                ADD CONSTRAINT fkUserKeEksemplar FOREIGN KEY (idUser) REFERENCES users(id)
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanPeminjaman
                ADD CONSTRAINT fkEksemplarKePeminjaman FOREIGN KEY (kodeEksemplar) REFERENCES KumpulanEksemplar(kodeEksemplar),
                ADD CONSTRAINT fkUserKePeminjaman FOREIGN KEY (idUser) REFERENCES users(id),
                ADD CONSTRAINT fkDendaPeminjaman FOREIGN KEY (fkDenda) REFERENCES AturanDenda(hariKe)
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
            'ALTER TABLE kumpulankatadanbuku 
                DROP INDEX fkBukuKumpulanBuku,
                DROP INDEX fkKataBukuKumpulanBuku
            '
          );
         
          DB::statement(
            'ALTER TABLE KumpulanBuku 
                DROP INDEX fkBukuKePenerbit,
                DROP INDEX fkBukukePengarang
            '
          );
        
          DB::statement(
            'ALTER TABLE KumpulanBukudanKumpulanKategori 
                DROP INDEX fkBukuKeKategori,
                DROP INDEX fkKategorikeKategori
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanEksemplar
                DROP INDEX fkBukuKeEksemplar
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanPemesanan
                DROP INDEX fkBukuKePemesanan,
                DROP INDEX fkUserKeEksemplar
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanPeminjaman
                DROP INDEX fkEksemplarKePeminjaman,
                DROP INDEX fkUserKePeminjaman,
                DROP INDEX fkDendaPeminjaman
            '
          );
    }
}
