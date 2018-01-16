<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActiviteitenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activiteiten', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_idx');
			$table->integer('automaat_id')->nullable()->index('automaat_idx');
			$table->dateTime('begin_datum');
			$table->dateTime('eind_datum')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activiteiten');
	}

}
