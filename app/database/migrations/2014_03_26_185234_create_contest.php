<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContest extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('contests', function($table){
			$table->increments('id');
			$table->string('contest_name');
			$table->text('contest_description')->nullable();
			$table->date('contest_date');
			$table->integer('season_id')->references('seasons')->on('id');
			$table->integer('division_id')->references('divisions')->on('id');
			$table->string('contest_standing_url');
			$table->string('contest_judge_data_url')->nullable();
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
		Schema::drop('contests');
	}

}
