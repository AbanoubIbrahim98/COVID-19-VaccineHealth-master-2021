<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionalPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('regional_package', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('package_number');
            $table->integer('source_id');
            $table->integer('district_id');
            $table->string('date_sent');
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
		Schema::drop('regional_package');
	}

}
