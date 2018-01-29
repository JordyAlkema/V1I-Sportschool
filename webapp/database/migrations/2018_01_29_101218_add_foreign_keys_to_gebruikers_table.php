<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGebruikersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('gebruikers', function(Blueprint $table)
        {
            $table->foreign('rol_id', 'gebruiker-rol')->references('id')->on('rol')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('locatie_id', 'medewerker-locatie')->references('id')->on('locaties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('transacties', function(Blueprint $table) {
            $table->dropForeign('gebruiker-rol');
            $table->dropForeign('medewerker-locatie');
        });
    }
}
