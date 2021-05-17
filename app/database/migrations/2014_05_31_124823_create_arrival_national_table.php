<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalNationalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrival_national', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("ssc");
            $table->string("lot_number");
            $table->string("GTIN");
            $table->string("number_as_expected");
            $table->integer('number_received');
            $table->integer('number_expected');
            $table->string("problem");
            $table->string("temperature_monitor");
            $table->string("physcal_damege");
            $table->string("vvm_status");
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
		Schema::drop('arrival_national');
	}

}
