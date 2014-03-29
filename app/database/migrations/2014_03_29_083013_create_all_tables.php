<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email', 255);
			$table->string('password', 64);
			$table->string('firstname', 255);
			$table->string('lastname', 255);
			$table->boolean('status');
			$table->integer('role_id');
			$table->integer('profile_id');
			$table->timestamps();
		});
		Schema::create('roles', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('description', 255)->nullable();
			$table->timestamps();
		});
		Schema::create('profile', function($table)
		{
			$table->increments('id');
			$table->integer('image_id')->nullable();
			$table->integer('imageable_id')->nullable();
			$table->string('imageable_type')->nullable();
			$table->integer('spark_id');
			$table->longText('description')->nullable();
			$table->string('type');
			$table->integer('succesfull_projects');
			$table->integer('failed_projects');
			$table->timestamps();
		});
		Schema::create('sparks', function($table){
			$table->increments('id');
			$table->integer('value');
			$table->timestamps();
		});
		Schema::create('projects', function($table){
			$table->increments('id');
			$table->integer('profile_id');
			$table->string('name', 255);
			$table->longText('description');
			$table->integer('imageable_id')->nullable();
			$table->string('imageable_type')->nullable();
			$table->integer('file_id')->nullable();
			$table->integer('fundings');
			$table->dateTime('expire_date');
			$table->timestamps();
		});
		Schema::create('profile_project', function($table){
			$table->increments('id');
			$table->integer('profile_id');
			$table->integer('project_id');
			$table->timestamps();
		});
		Schema::create('comments', function($table){
			$table->increments('id');
			$table->integer('project_id');
			$table->boolean('parent');
			$table->integer('profile_id');
			$table->longText('body');
			$table->timestamps();
		});
		Schema::create('gallery', function($table){
			$table->increments('id');
			$table->integer('profile_id');
			$table->timestamps();
		});
		Schema::create('image_gallery', function($table){
			$table->increments('id');
			$table->integer('gallery_id');
			$table->integer('image_id');
			$table->timestamps();
		});
		Schema::create('document_gallery', function($table){
			$table->increments('id');
			$table->integer('gallery_id');
			$table->integer('file_id');
			$table->timestamps();
		});
		Schema::create('document', function($table){
			$table->increments('id');
			$table->string('type', 255);
			$table->string('name', 255);
			$table->string('title', 255);
			$table->string('path', 255);
			$table->string('mime', 255);
			$table->string('size');
			$table->string('document_type', 255);
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
		Schema::drop('users');
		Schema::drop('roles');
		Schema::drop('profile');
		Schema::drop('sparks');
		Schema::drop('projects');
		Schema::drop('profile_project');
		Schema::drop('comments');
		Schema::drop('gallery');
		Schema::drop('image_gallery');
		Schema::drop('document_gallery');
		Schema::drop('document');
	}

}
