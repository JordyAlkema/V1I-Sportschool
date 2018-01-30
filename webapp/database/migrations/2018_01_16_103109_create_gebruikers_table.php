<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGebruikersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gebruikers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('voornaam', 45)->nullable();
			$table->string('tussenvoegsel', 45)->nullable();
			$table->string('achternaam', 45)->nullable();
            $table->integer('rol_id')->unsigned()->index('rol_idx');

            //Alleen voor medewerkers
            $table->integer('locatie_id')->unsigned()->nullable()->index('locatie_idx');

			$table->string('email', 80)->unique();
			$table->string('wachtwoord', 80);
			$table->date('geboortedatum')->nullable();
			$table->string('pasnummer', 45)->nullable();
			$table->string('remember_token', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gebruikers');
	}

}
