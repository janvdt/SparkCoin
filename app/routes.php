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
Route::post('signin', 'HomeController@postSignin');
Route::post('register', 'HomeController@postRegister');
Route::get('profile/show', 'ProfileController@getDashboard');
Route::post('images', 'ImageController@index');
Route::resource('projects', 'ProjectController');
Route::resource('user', 'UserController');
Route::get('files', 'FileController@index');
Route::post('files', 'FileController@store');
Route::delete('files/{id}', 'FileController@destroy');
Route::post('gallery/destroySelected', 'GalleryController@destroySelected');
Route::get('user/viewauthentication/', 'UserController@viewauthentication'); 
Route::post('user/validateauthentication/', 'UserController@validateauthentication');
Route::get('projects/sort/{type}','ProjectController@sort');
Route::post('projects/projectsuccess/','ProjectController@projectSuccess');
Route::get('files', 'FileController@index');
Route::post('files', 'FileController@store');
Route::delete('files/{id}', 'FileController@destroy');
Route::get('profile/yourprogress/', 'ProfileController@yourProgress');
Route::get('profile/showyours/', 'ProfileController@showYours');
Route::delete('gallery/destroyimage/{id}', 'GalleryController@destroyImage');
Route::resource('media', 'MediaController');
Route::resource('document', 'DocumentController');
Route::post('images', 'ImageController@index');
Route::resource('projects', 'ProjectController');
Route::resource('user', 'UserController');
Route::resource('comment', 'CommentController');
Route::resource('profile', 'ProfileController');
Route::resource('databank', 'DatabankController');
Route::resource('gallery', 'GalleryController');
Route::post('fund/postfund','FundController@postFund');
Route::post('document/storedocument', 'DocumentController@storeDocument');
Route::post('documents/destroySelected', 'FileController@destroySelected');
Route::get('gallery/upload/{id}', 'GalleryController@uploadImage');
Route::post('gallery/store', 'GalleryController@storeImage');

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});
