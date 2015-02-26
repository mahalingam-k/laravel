<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionSubdivisionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('institution_subdivision', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('institution_id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->foreign('institution_id')->references('id')->on('institution');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('institution_subdivision');
	}

}
