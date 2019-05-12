<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateProcedureShowRecommenddationWithOffset extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $sql = "CREATE PROCEDURE ShowRecommendation
            (
              IN idUser_param int,
              IN limit_param int
            )
            BEGIN
              SELECT nama,idBuku
              FROM (
                SELECT 
                  RecommendationTable.kodeBukuKedua
                FROM (
                  SELECT kodeEksemplar
                  FROM 
                    KumpulanPeminjaman
                  WHERE idUser = idUser_param
                ) as TableKodeEksemparTemp
                INNER JOIN KumpulanEksemplar on KumpulanEksemplar.kodeEksemplar = TableKodeEksemparTemp.kodeEksemplar
                INNER JOIN RecommendationTable on RecommendationTable.kodeBukuPertama = KumpulanEksemplar.idBuku
                ORDER BY RecommendationTable.support DESC
                LIMIT limit_param
              ) as tableRecommendationSpesificUser
              INNER JOIN KumpulanBuku on KumpulanBuku.idBuku = tableRecommendationSpesificUser.kodeBukuKedua;
            END";
            DB::connection()->getPdo()->exec($sql);
    $sql = "CREATE PROCEDURE ShowBukuWithLimit
            (
              IN limit_param int
            )
            BEGIN
              SELECT nama,idBuku
              FROM KumpulanBuku
              LIMIT limit_param;
            END
    ";
    DB::connection()->getPdo()->exec($sql);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::unprepared("DROP PROCEDURE IF EXISTS ShowRecommendation");
    DB::unprepared("DROP PROCEDURE IF EXISTS ShowBukuWithLimit");
  }
}
