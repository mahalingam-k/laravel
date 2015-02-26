<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique;
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
			$table->string('role');
			$table->timestamp('last_logged_in_time');
			$table->integer('total_visits')->default(0);
			$table->integer('is_deleted');
			$table->integer('is_banned');
			$table->string('remember_token', 100)->nullable();
			$table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
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
		Schema::drop('users');	
	}
}