<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalStockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('national_stock', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("number_of_doses");
            $table->string("lot_number");
            $table->string("expiry_date");
            $table->string("GTIN");
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
		Schema::drop('national_stock');
	}

}
