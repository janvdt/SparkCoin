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



Route::post('images', 'ImageController@index');
Route::resource('projects', 'ProjectController');
Route::resource('user', 'UserController');
Route::get('files', 'FileController@index');
Route::post('files', 'FileController@store');
Route::delete('files/{id}', 'FileController@destroy');


Route::get('user/viewauthentication/', 'UserController@viewauthentication'); 
Route::post('user/validateauthentication/', 'UserController@validateauthentication');
Route::get('projects/sort/{type}','ProjectController@sort');
Route::post('projects/projectsuccess/','ProjectController@projectSuccess');
Route::get('files', 'FileController@index');
Route::post('files', 'FileController@store');
Route::delete('files/{id}', 'FileController@destroy');
Route::get('profile/yourprogress/', 'ProfileController@yourProgress');
Route::get('profile/showyours/', 'ProfileController@showYours');

Route::post('images', 'ImageController@index');
Route::resource('projects', 'ProjectController');
Route::resource('user', 'UserController');
Route::resource('comment', 'CommentController');
Route::resource('profile', 'ProfileController');




Route::get('login', array('as' => 'login', function()
{
	return View::make('instance.login');
}));

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});
