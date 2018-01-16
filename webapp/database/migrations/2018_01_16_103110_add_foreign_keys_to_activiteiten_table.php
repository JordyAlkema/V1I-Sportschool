<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActiviteitenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activiteiten', function(Blueprint $table)
		{
			$table->foreign('automaat_id', 'automaat')->references('id')->on('automaten')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'user')->references('id')->on('gebruikers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activiteiten', function(Blueprint $table)
		{
			$table->dropForeign('automaat');
			$table->dropForeign('user');
		});
	}

}
