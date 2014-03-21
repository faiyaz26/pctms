<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendUserInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_infos', function($table)
		{
		    $table->integer('division_id')->references('id')->on('divisions')->onDelete("set null")->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_infos', function($table){
			$table->dropColumn('division_id');
		});
	}

}
