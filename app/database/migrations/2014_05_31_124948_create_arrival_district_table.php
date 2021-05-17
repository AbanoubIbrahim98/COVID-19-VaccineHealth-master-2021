<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalDistrictTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrival_district', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('regional_package');
            $table->integer('number_of_packages');
            $table->integer('district_id');
            $table->string("lot_number");
            $table->string("number_of_doses");
            $table->string("vaccine_id");
            $table->string("number_as_expected");
            $table->string("problem");
            $table->integer('receiver');
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
		Schema::drop('arrival_district');
	}

}
