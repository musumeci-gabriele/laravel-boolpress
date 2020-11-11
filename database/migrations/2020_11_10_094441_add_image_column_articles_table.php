<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumnArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // * Creiamo una colonna per il db
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {

            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */

    //  * Qui distuggiamo la colonna con il comando rollback
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {

            $table->dropColumn('image');
        });
    }
}
