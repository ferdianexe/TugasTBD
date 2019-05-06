<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpKembalikanBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE PROCEDURE kembalikanBuku (
            IN inputIdUser int,
            IN inputKodeEksemplar int,
            IN tglPeminjaman timestamp,
            IN tglJatuhTempo date,
            IN tglDikembalikan timestamp
        )
        BEGIN
            DECLARE dendanya decimal(15,2);
            DECLARE telatBrpHari int;

            SET telatBrpHari = DATEDIFF(tglDikembalikan, tglJatuhTempo);
            IF telatBrpHari > 10 THEN 
                SET dendanya = 
                    (
                        SELECT hargaBuku
                        FROM kumpulaneksemplar inner join kumpulanbuku on kumpulaneksemplar.idBuku = kumpulanbuku.idBuku
                        WHERE kumpulaneksemplar.kodeEksemplar = inputKodeEksemplar
                    );
            ELSEIF telatBrpHari > 0 THEN
                SET dendanya =
                    (
                        SELECT nominalDenda
                        FROM aturandenda
                        WHERE hariKe = telatBrpHari
                    );
            ELSE SET dendanya = 0;
            END IF;

            -- UPDATE RECORD
            IF telatBrpHari>0 and telatBrpHari<=10 THEN
                UPDATE kumpulanpeminjaman
                SET hasReturned = 1 , totalDenda = dendanya, fkDenda = telatBrpHari, tanggalDibalikan = tglDikembalikan
                WHERE idUser = inputIdUser and kodeEksemplar = inputKodeEksemplar and tanggalMeminjam = tglPeminjaman and hasReturned = 0;
            ELSE
                UPDATE kumpulanpeminjaman
                SET hasReturned = 1 , totalDenda = dendanya, tanggalDibalikan = tglDikembalikan
                WHERE idUser = inputIdUser and kodeEksemplar = inputKodeEksemplar and tanggalMeminjam = tglPeminjaman and hasReturned = 0;
            END IF;

            UPDATE kumpulaneksemplar
            SET statusPeminjaman = 0
            WHERE kodeEksemplar = inputKodeEksemplar; 
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
        DB::unprepared("DROP PROCEDURE kembalikanBuku");
    }
}
