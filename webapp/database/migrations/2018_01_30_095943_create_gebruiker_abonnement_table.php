<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGebruikerAbonnementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gebruiker_abonnement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gebruiker_id')->unsigned()->nullable()->index('gebruiker_id3');
            $table->integer('abonnement_id')->unsigned()->nullable()->index('abonnement_id3');
            $table->date('begin_datum');
            $table->date('eind_datum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gebruiker_abonnement');
    }
}
