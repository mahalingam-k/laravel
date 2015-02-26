<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentReferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_references', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key_name')->unique;
			$table->string('value_name')->nullable();
			$table->integer('reference_document_number')->default(0);
			$table->integer('referred_document_number')->default(0);
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
		Schema::drop('document_references');
	}

}
