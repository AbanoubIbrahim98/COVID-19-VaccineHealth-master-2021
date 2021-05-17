<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictStockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('district_stock', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('district_id');
            $table->string("number_of_doses");
            $table->string("lot_number");
            $table->string("vaccine_id");
            $table->string("expiry_date");
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
		Schema::drop('district_stock');
	}

}
