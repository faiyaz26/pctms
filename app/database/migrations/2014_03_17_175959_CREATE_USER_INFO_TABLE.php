<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CREATEUSERINFOTABLE extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// User extended infos table creating
		Schema::create('user_infos', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')
      		->onDelete('cascade')->unique();
            $table->string('full_name');
            $table->string('cf_handle')->default("");
            $table->string('loj_handle')->default("");
            $table->string('spoj_handle')->default("");
            $table->string('uva_handle')->default('');
            $table->string('cc_handle')->default("");
            $table->string('sgu_handle')->default("");
            $table->string('hustoj_handle')->default("");
            $table->string('cm_handle')->default("");
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
		Schema::drop('user_infos');
	}

}
