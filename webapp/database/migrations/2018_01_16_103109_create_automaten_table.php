<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAutomatenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('automaten', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('naam', 45);
			$table->float('bedrag_per_minuut', 10, 0);
			$table->integer('locatie_id')->unsigned()->nullable()->index('locatie_idx');
			$table->integer('automaat_type_id')->unsigned()->index('AutomaatType_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('automaten');
	}

}
