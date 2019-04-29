<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class TagFavoritTiapAnggota extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    
    $sql ="CREATE PROCEDURE TagFavoritPerAnggota(
      IN id_val INT
    ) 
    BEGIN
      DECLARE totalPeminjaman INT ;
      SELECT 
        count(kodeEksemplar) INTO totalPeminjaman
      FROM 
        KumpulanPeminjaman
      WHERE 
        idUser = id_val ;
      SELECT 
        kodeEksemplar 
      FROM 
        KumpulanPeminjaman
      WHERE 
        idUser = id_val ;
    END";
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      //
  }
}
