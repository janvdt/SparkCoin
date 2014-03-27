<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
	

		$img = Image::make('uploads/ing.jpg');
		$img->crop(100, 100, 25, 25);
		$img->blur(15);

		$path = $img->dirname ."/". $img->basename;

		return View::make('hello')->with('path',$path);
	}

}