<?php

class Randomizer {

	/*
	 |--------------------------------------------------------------------------
	 | RANDOMIZER LIBRARY CLASS
	 |--------------------------------------------------------------------------
	 |
	 | This class generates all kinds of random stuff like intigers (e.g. id's),
	 | strings, etc...
	 |
	 */

	 /**
	 * Generates a unique variable based on a hashed timestamp
	 * return int
	 */
	public static function generate_unique( $type, $length = 7 )
	{
		if ($type == 'int')
		{
			$unique = substr( preg_replace( '/\D/', '', md5( time() ) ), 0, $length );
		}
		else if ($type == 'string')
		{
			$unique = substr( md5( time() ), 0, 15 );
		}

		return $unique;
	}


	public static function generate_string( $length = 7 )
	{
		$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$start 	= rand( 0, strlen($charset) - $length );
		$random 	= str_shuffle( $charset );
		
		return substr($random, $start, $length );
	}
}