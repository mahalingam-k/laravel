<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchedTermsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('searched_terms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			
			$table->string('search_term')->nullable();
			$table->string('title')->nullable();
			$table->string('parties')->nullable();
			$table->string('citation')->nullable();
			$table->string('judges')->nullable();
			$table->date('from_date')->nullable();
			$table->date('to_date')->nullable();
			$table->timestamp('searched_on');
			$table->integer('document_count')->default(0);
			$table->string('document_ids')->nullable();
			$table->boolean('alert_flag');
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
		Schema::drop('searched_terms');
	}

}
