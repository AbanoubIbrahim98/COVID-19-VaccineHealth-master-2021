<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vaccine', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("name");
            $table->string("GTIN");
            $table->string("doses_per_vial");
            $table->string("vials_per_box");
            $table->string("packaging");
            $table->string("country_id");
            $table->string("manufacturer");
            $table->string("type");
            $table->integer("warning_period");
            $table->float("wastage");
            $table->integer("schedule");
            $table->string("status");
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
		Schema::drop('vaccine');
	}

}
