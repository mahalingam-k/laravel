<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_notification', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('created_by');
			$table->integer('notification_code');
			$table->string('notification_type');
			$table->string('subject');
			$table->string('message');
			$table->timestamps();
			$table->foreign('created_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_notification');
	}

}
