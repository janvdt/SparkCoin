<?php

/*
|--------------------------------------------------------------------------
| Extensions
|--------------------------------------------------------------------------
|
| Here is where you can register extensions. You need to require this file
| in `app/start/global.php`
|
| @location /app/extensions.php
|
*/


/*
 * BLADE INLINE PHP ------------------------------------------------------
 * 
 * Enables a shorthand inline php notation with Laravel's Blade
 * templating engine.
 *
 * @syntax {? $old_section = "whatever" ?}
 *
 */
Blade::extend( function( $value )
{
	return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
});
