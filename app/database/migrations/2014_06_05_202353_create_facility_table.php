<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facility', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('district_id');
            $table->string('name');
            $table->string('contact');
            $table->integer('target_population');
            $table->integer('annual_birth');
            $table->integer('surviving_infants');
            $table->integer('pregnancy');
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
		Schema::drop('facility');
	}

}
