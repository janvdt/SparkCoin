<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table) {
			$table->string('address');
			$table->integer('zipcode');
			$table->float('lat',10,6);
			$table->float('long',10,6);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table) {
			$table->dropColumn('address');
			$table->dropColumn('zipcode');
			$table->dropColumn('lat');
			$table->dropColumn('long');
		});
	}

}
