<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	if ( Auth::check() ) Session::put( 'admin', Auth::user() );
});


/*
|--------------------------------------------------------------------------
| Custom Route filters
|--------------------------------------------------------------------------
|
| Create some custom route filters to limit the access on or apply an 
| action to a certain route.
|
| @info http://laravel.com/docs/routing#route-filters
|
*/

// Sanitize all inputs (uses the Sanitizr library)
//
Route::filter('sanitize', function()
{
	Sanitizr::clean();
});


// Routes using this filter can only be accessed by an Ajax call
//
Route::filter('ajax', function()
{
	if ( ! Request::ajax() ) return App::abort(404);
});


// Logged in admin should be a super admin
//
Route::filter('admin.super', function()
{
	if ( Auth::check() )
	{
		if ( Auth::user()->super_admin != 1 ) return "This route required a super admin"; //App::abort(404);
	}
});


// Id passed to the controller should be the one from the logged in user
//
Route::filter('auth.same', function( $route )
{
	if ( Auth::check() )
	{
		if ( Auth::user()->id != $route->getParameter('id') ) return "You don't have the rights to change anything for this user"; //App::abort(404);
	}
});


/*
|--------------------------------------------------------------------------
| Pattern Based filters
|--------------------------------------------------------------------------
|
| You can use pattern based filters to apply a filter to apply a filter
| (sych as auth, guest, ...) to multiple routes at once.
|
| @info http://laravel.com/docs/routing#route-filters
|
*/

Route::when( '*', 'sanitize', array('post') );
