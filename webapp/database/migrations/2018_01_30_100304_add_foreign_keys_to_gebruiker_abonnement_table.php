<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGebruikerAbonnementTable extends Migration
{
    // Abonnement
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('gebruiker_abonnement', function(Blueprint $table)
        {
            $table->foreign('gebruiker_id', 'gebruiker-abonnement')->references('id')->on('gebruikers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('abonnement_id', 'abonnement-gebruiker')->references('id')->on('abonnement')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::table('gebruiker_abonnement', function(Blueprint $table) {
            $table->dropForeign('gebruiker-abonnement');
            $table->dropForeign('abonnement-gebruiker');
        });
    }
}
