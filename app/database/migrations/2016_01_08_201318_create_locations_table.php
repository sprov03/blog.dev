<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('locations' , function(Blueprint $table)
		{
			$table->integer('locId')->unsinged()->primary();
			$table->char('country', 2);
			$table->char('region' , 2);
			$table->string('city', 50);
			$table->string('postalCode', 20);
			$table->double('latitude',7,4);
			$table->double('longitude',7,4);
			$table->integer('dmacode',11);
			$table->integer('areaCode',11);

			// $table->primary('locId');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}

}
