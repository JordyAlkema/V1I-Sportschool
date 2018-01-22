<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedewerkerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medewerker', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('naam', 45);
			$table->string('tussenvoegsel', 45)->nullable();
			$table->string('achternaam', 45);
			$table->string('email', 45);
			$table->string('telefoonnummer', 45)->nullable();
			$table->integer('locatie_id')->unsigned()->index('locatie_medewerker_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('medewerker');
	}

}
