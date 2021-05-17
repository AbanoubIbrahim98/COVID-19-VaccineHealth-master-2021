<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionStockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('region_stock', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer("region_id");
            $table->string("number_of_doses");
            $table->string("lot_number");
            $table->string("expiry_date");
            $table->string("vaccine_id");
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
		Schema::drop('region_stock');
	}

}
