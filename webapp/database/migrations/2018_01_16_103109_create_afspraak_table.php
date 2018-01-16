<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAfspraakTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('afspraak', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('medewerker_id')->index('afspraak_medewerker_idx');
			$table->integer('user_id')->index('afspraak_user_idx');
			$table->dateTime('email_verstuurd')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('afspraak');
	}

}
