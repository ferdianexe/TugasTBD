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
                DROP FOREIGN KEY fkBukuKumpulanBuku,
                DROP FOREIGN KEY fkKataBukuKumpulanBuku
            '
          );
         
          DB::statement(
            'ALTER TABLE KumpulanBuku 
                DROP FOREIGN KEY fkBukuKePenerbit,
                DROP FOREIGN KEY fkBukukePengarang
            '
          );
        
          DB::statement(
            'ALTER TABLE KumpulanBukudanKumpulanKategori 
                DROP FOREIGN KEY fkBukuKeKategori,
                DROP FOREIGN KEY fkKategorikeKategori
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanEksemplar
                DROP FOREIGN KEY fkBukuKeEksemplar
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanPemesanan
                DROP FOREIGN KEY fkBukuKePemesanan,
                DROP FOREIGN KEY fkUserKeEksemplar
            '
          );
          
          DB::statement(
            'ALTER TABLE KumpulanPeminjaman
                DROP FOREIGN KEY fkEksemplarKePeminjaman,
                DROP FOREIGN KEY fkUserKePeminjaman,
                DROP FOREIGN KEY fkDendaPeminjaman
            '
          );
    }
}
