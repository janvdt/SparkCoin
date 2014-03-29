<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFundingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table) {
			$table->dropColumn('fundings');
			$table->integer('fund_id');
		});		
		Schema::create('project_funds', function($table){
			$table->increments('id');
			$table->integer('profile_id');
			$table->integer('project_id');
			$table->timestamps();
		});
		Schema::create('funds', function($table){
			$table->increments('id');
			$table->integer('total');
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
		$table->integer('fundings');
		$table->dropColumn('fund_id');
		Schema::drop('project_funds');
		Schema::drop('funds');
	}

}
