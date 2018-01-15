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
			$table->foreign('activiteit_id', 'activiteit123')->references('id')->on('activiteit')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('transactieType_id', 'type123')->references('id')->on('transactietype')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'user123')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('activiteit123');
			$table->dropForeign('type123');
			$table->dropForeign('user123');
		});
	}

}
