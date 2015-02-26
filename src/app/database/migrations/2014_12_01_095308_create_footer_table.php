<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('footer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type')->nullable();
			$table->binary('content')->nullable();
			
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
		Schema::drop('footer');
	}

}
