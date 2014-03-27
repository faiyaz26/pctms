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
            $table->string('cf_handle')->default("")->nullable();
            $table->string('loj_handle')->default("")->nullable();
            $table->string('spoj_handle')->default("")->nullable();
            $table->string('uva_handle')->default('')->nullable();
            $table->string('cc_handle')->default("")->nullable();
            $table->string('sgu_handle')->default("")->nullable();
            $table->string('hustoj_handle')->default("")->nullable();
            $table->string('cm_handle')->default("")->nullable();
            $table->string('tc_handle')->default("")->nullable();
            $table->integer('division_id')->references('id')->on('divisions')->onDelete("set null")->default(null)->nullable();
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
