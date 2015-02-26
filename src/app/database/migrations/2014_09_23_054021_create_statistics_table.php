<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statistics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('ip_address');
			$table->string('searchterm');
			$table->string('content');						
			$table->timestamp('action_on');
			$table->integer('document_count')->default(0);
			$table->string('document_ids')->nullable();
			$table->string('action');
			$table->boolean('is_deleted');
            $table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('statistics');
	}

}
