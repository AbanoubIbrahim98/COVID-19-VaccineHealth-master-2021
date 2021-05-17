<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionalInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('region_inventory', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('reporting_period');
            $table->integer('user_id');
            $table->integer('region_id');
            $table->string('lot_number');
            $table->string('GTIN');
            $table->integer('boxes');
            $table->integer('vials');
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
		Schema::drop('region_inventory');
	}

}
