<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShowStoredProcedureDendaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE ShowDendaKu (
            IN inputIdUser int,
            IN tglNow date
        )
        BEGIN

            CREATE TABLE eksemplarDanTelat(
                kodeEksemplar int,
                telatBalikin int
            ); 

            insert into eksemplarDanTelat (kodeEksemplar,telatBalikin)
                select kodeEksemplar, datediff(tglNow,tglJatuhTempo)+1
                from kumpulanpeminjaman
                where idUser = inputIdUser;

            -- info yang akan diberikan
            -- (namaBuku, tglMinjam, tglJatuhTempo, totalDenda)
            SELECT
                kumpulanbuku.nama, tanggalMeminjam, tglJatuhTempo, nominalDenda
            FROM 
                kumpulanpeminjaman 
                inner join kumpulaneksemplar on kumpulaneksemplar.kodeEksemplar = kumpulanpeminjaman.kodeEksemplar
                inner join kumpulanbuku on kumpulanbuku.idBuku = kumpulaneksemplar.idBuku
                inner join eksemplarDanTelat on eksemplarDanTelat.kodeEksemplar = kumpulanpeminjaman.kodeEksemplar
                left outer join aturandenda on aturandenda.hariKe = eksemplarDanTelat.telatBalikin
            WHERE
                kumpulanpeminjaman.idUser = inputIdUser and telatBalikin > 0 and hasReturned = 1;
            
            DROP TABLE eksemplarDanTelat;
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
        DB::unprepared("DROP PROCEDURE ShowDendaKu");
    }
}
