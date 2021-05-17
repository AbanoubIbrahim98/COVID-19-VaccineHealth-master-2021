<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('national_package', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('region_id');
            $table->string('date_sent');
            $table->string('package_number');
            $table->string('date_received');
            $table->string('comments');
            $table->string('received_status');
            $table->integer('sender');
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
		Schema::drop('national_package');
	}

}
