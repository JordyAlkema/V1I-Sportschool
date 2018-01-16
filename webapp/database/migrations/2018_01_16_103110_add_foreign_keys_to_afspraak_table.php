<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAfspraakTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('afspraak', function(Blueprint $table)
		{
			$table->foreign('medewerker_id', 'afspraak_medewerker')->references('id')->on('medewerker')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'afspraak_user')->references('id')->on('gebruikers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('afspraak', function(Blueprint $table)
		{
			$table->dropForeign('afspraak_medewerker');
			$table->dropForeign('afspraak_user');
		});
	}

}
