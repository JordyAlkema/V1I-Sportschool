<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActiviteitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activiteit', function(Blueprint $table)
		{
			$table->foreign('automaat_id', 'automaat')->references('id')->on('automaat')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'user')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activiteit', function(Blueprint $table)
		{
			$table->dropForeign('automaat');
			$table->dropForeign('user');
		});
	}

}
