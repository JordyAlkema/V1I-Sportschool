<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMedewerkerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medewerker', function(Blueprint $table)
		{
			$table->foreign('locatie_id', 'locatie_medewerker')->references('id')->on('locaties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medewerker', function(Blueprint $table)
		{
			$table->dropForeign('locatie_medewerker');
		});
	}

}
