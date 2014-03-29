<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$HomeController = new HomeController;


	return $HomeController->index();
});

	Route::get('files', 'FileController@index');
	Route::post('files', 'FileController@store');
	Route::delete('files/{id}', 'FileController@destroy');
	Route::post('images', 'ImageController@index');
	Route::resource('user', 'UserController');

Route::get('login', array('as' => 'login', function()
{
	return View::make('instance.login');
}));