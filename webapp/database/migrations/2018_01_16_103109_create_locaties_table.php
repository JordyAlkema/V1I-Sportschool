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
			$table->string('stad', 45);
			$table->string('straat', 45);
			$table->string('huisnummer', 45);
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
