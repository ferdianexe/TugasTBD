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
            -- DECLARE totalDenda decimal(15,2);
            CREATE TABLE eksemplarDanTelat(
                namaBuku varchar(50),
                kodeEksemplar int,
                tanggalMeminjam date,
                tglJatuhTempo date,
                hargaBuku decimal(15,2),
                hasReturned int,
                telatBalikin int
            ); 

            insert into eksemplarDanTelat (namaBuku,kodeEksemplar,tanggalMeminjam,tglJatuhTempo,hargaBuku,hasReturned,telatBalikin)
                select 
                    kumpulanbuku.nama, kumpulanpeminjaman.kodeEksemplar, kumpulanpeminjaman.tanggalMeminjam, kumpulanpeminjaman.tglJatuhTempo, 
                    kumpulanbuku.hargaBuku, kumpulanpeminjaman.hasReturned, datediff(tglNow,kumpulanpeminjaman.tglJatuhTempo)+1
                from 
                    kumpulanpeminjaman
                    inner join kumpulaneksemplar on kumpulaneksemplar.kodeEksemplar = kumpulanpeminjaman.kodeEksemplar
                    inner join kumpulanbuku on kumpulanbuku.idBuku = kumpulaneksemplar.idBuku
                where kumpulanpeminjaman.idUser = inputIdUser;

            -- OUTPUT
            SELECT 
                namaBuku, tanggalMeminjam, tglJatuhTempo, 
                IF(telatBalikin>14, hargaBuku , nominalDenda ) as totalDenda
            FROM
                eksemplarDanTelat 
                left outer join aturandenda on aturandenda.hariKe = eksemplarDanTelat.telatBalikin
            WHERE
                hasReturned = 1;
            
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
