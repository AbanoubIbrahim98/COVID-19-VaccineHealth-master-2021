<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vaccine_problems', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('arrival_id');
            $table->string('level');
            $table->string('lot_number');
            $table->string('alarm_temperature');
            $table->string('cold_chain_monitor');
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
		Schema::drop('vaccine_problems');
	}

}
