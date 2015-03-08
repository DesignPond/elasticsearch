<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->longText('text');
            $table->longText('ranges');
            $table->longText('tags');
            $table->string('uri');
            $table->text('quote');
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
		Schema::drop('annotations');
	}

}
