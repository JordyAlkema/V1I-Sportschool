<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transacties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('user_idx');
			$table->integer('transactieType_id')->unsigned()->index('type_idx');
			$table->float('bedrag', 10, 0)->nullable();
			$table->date('datum');
			$table->integer('activiteit_id')->unsigned()->nullable()->index('activiteit_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transacties');
	}

}
