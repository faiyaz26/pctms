<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestSummaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('contest_summary', function($table){
			$table->increments('id');
			$table->string('username');
			$table->integer('contest_id');
			$table->integer('position');
			$table->integer('points');
			$table->integer('solved');
			$table->integer('attempt');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('contest_summary');
	}

}
