<?php

/*
|--------------------------------------------------------------------------
| Custom Validation Rules
|--------------------------------------------------------------------------
|
| Here is where you can register custom validation rules. You need to  
| require this file in `app/start/global.php`
|
| @location /app/validators.php
|
*/

Validator::extend('awesome', function($field, $value, $params)
{
    return $value == 'awesome';
});

Validator::extend('update_email', function($field, $value, $params)
{
	if ( $value !== Auth::user()->email )
	{
		if ( DB::table( $params[0] ) -> where( 'email', '=', $value ) -> first() == NULL ) return true;
		else return false;
	}
   else
   {
   	return true;
   }
});
