<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs' , function(Blueprint $table) {
			$table->increments('id');
			$table->integer('card_id');
			$table->integer('room_id');
			$table->string('date');
			$table->timestamp('access');
			$table->timestamps();

			$table->index(array('room_id', 'date'));
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logs');
	}

}
