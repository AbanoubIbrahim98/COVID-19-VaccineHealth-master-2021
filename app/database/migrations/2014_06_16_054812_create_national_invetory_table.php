<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalInvetoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('national_inventory', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('reporting_period');
            $table->integer('user_id');
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
		Schema::drop('national_inventory');
	}

}
