<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('level_id')->unsigned();
			$table->foreign('level_id')->references('id')->on('levels');
			$table->string('function',50);
			$table->double('x', 10,4);
			$table->double('y', 10,4);
			$table->double('width', 10,4);
			$table->double('height', 10,4);
			$table->string('color', 50);
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
		Schema::drop('calls');
	}

}