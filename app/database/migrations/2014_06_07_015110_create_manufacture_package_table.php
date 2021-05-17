<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturePackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('manufacture_package', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('sscc');
            $table->integer("vaccine_id");
            $table->string("manufacture_date");
            $table->string("expiry_date");
            $table->string("lot_number");
            $table->string("number_of_doses");
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
		Schema::drop('manufacture_package');
	}

}
