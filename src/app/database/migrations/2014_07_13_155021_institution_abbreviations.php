<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstitutionAbbreviations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('institution', function($table)
        {
            $table->string('abbreviation');
        });

        Schema::table('institution_subdivision', function($table)
        {
            $table->string('abbreviation');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('institution', function($table)
        {
            $table->dropColumn('abbreviation');
        });

        Schema::table('institution_subdivision', function($table)
        {
            $table->dropColumn('abbreviation');
        });
	}

}
