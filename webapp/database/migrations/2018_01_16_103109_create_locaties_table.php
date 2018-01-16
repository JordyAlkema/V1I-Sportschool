<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocatiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locaties', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('naam', 45);
			$table->string('Stad', 45);
			$table->string('Straat', 45);
			$table->string('Huisnummer', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locaties');
	}

}
