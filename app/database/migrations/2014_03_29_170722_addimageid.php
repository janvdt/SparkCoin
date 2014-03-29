<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addimageid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::table('projects', function(Blueprint $table) {
			$table->dropColumn('imageable_id','imageable_type');
			$table->integer('image_id');

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
			$table->dropColumn('image_id');
			$table->integer('imageable_id');
			$table->string('imageable_type');
		});
	}

}
