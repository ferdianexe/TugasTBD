<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddColouminUsersTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
      DB::statement(
        "ALTER TABLE 
          users 
         ADD hakStatus TINYINT(2) NOT NULL DEFAULT 0 AFTER updated_at"
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
        'ALTER TABLE 
          `users`
         DROP 
          `hakStatus`'
      );
    }
}
