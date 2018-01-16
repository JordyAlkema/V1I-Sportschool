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
			$table->integer('id', true);
			$table->string('voornaam', 45);
			$table->string('tussenvoegsel', 45)->nullable();
			$table->string('achternaam', 45);
			$table->string('email', 80);
			$table->string('wachtwoord', 80);
			$table->date('geboortedatum');
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
