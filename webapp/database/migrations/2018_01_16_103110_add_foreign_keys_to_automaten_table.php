<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAutomatenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('automaten', function(Blueprint $table)
		{
			$table->foreign('automaat_type_id', 'AutomaatType')->references('id')->on('automaattype')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('locatie_id', 'locatie')->references('id')->on('locaties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('automaten', function(Blueprint $table)
		{
			$table->dropForeign('AutomaatType');
			$table->dropForeign('locatie');
		});
	}

}
