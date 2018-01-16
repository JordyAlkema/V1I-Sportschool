<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransactiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transacties', function(Blueprint $table)
		{
			$table->foreign('activiteit_id', 'activiteit1')->references('id')->on('activiteiten')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('transactieType_id', 'type1')->references('id')->on('transactietype')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'user1')->references('id')->on('gebruikers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transacties', function(Blueprint $table)
		{
			$table->dropForeign('activiteit1');
			$table->dropForeign('type1');
			$table->dropForeign('user1');
		});
	}

}
