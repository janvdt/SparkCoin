<?php

class Notification {

	/*
	 |--------------------------------------------------------------------------
	 | NOTIFICATION LIBRARY CLASS
	 |--------------------------------------------------------------------------
	 |
	 | This class contains all possible custom notifications of the application
	 |
	 */

	 private static $notif = array();


	 /*
	  * Sign up / Registrations
	  */
	 public static function signup_success()
	 {
	 	self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> "You signed up successfully!"
	 	);
	 	return self::$notif;
	 }

	 public static function signup_failed()
	 {
	 	self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> "Whoops! Something went wrong while trying to sign you up..."
	 	);
	 	return self::$notif;
	 }


 /*
  * Login & logout
  */
	 public static function login_success()
	 {
	 	self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> "You logged in successfully!"
	 	);
	 	return self::$notif;
	 }

	 public static function login_error()
	 {
	 	self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> "Invalid username or password!"
	 	);
	 	return self::$notif;
	 }

	 public static function logout_success()
	 {
	 	self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> "You logged out successfully!"
	 	);
	 	return self::$notif;
	 }

	 public static function logout_error()
	 {
	 	self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> "Whoops! Something went wrong while trying to log you out..."
	 	);
	 	return self::$notif;
	 }


 /*
  * Settings
  */
	 public static function token_required()
	 {
	 	self::$notif = array(
	 		"type" 		=> "warning",
	 		"content"	=> "Before you can access your treesnaps, you need to link your treesnap ball's token to your account."
	 	);
	 	return self::$notif;
	 }

	 public static function wrong_token()
	 {
	 	self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> "Whoops, the token and the security code don't seem to match."
	 	);
	 	return self::$notif;
	 }

	 public static function token_error()
	 {
	 	self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> "Whoops! Something went wrong while trying to register your token..."
	 	);
	 	return self::$notif;
	 }


 /*
  * CRUD functionalities
  */
	 public static function delete_success()
	 {
	 	self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> "Your treesnap has been deleted successfully!"
	 	);
	 	return self::$notif;
	 }

	 public static function delete_error()
	 {
	 	self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> "Whoops! Something went wrong while trying to delete your treesnap..."
	 	);
	 	return self::$notif;
	 }


 /*
  * Treesnap specific
  */
	 public static function new_treesnaps( $amount )
	 {
	 	self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> ( $amount == 1 ? "There is 1 new treesnap!" : "There are ".$amount." new treesnaps!" )
	 	);
	 	return self::$notif;
	 }


/*
 * Postcard specific
 */
	public static function postcard_upload_succeeded()
	{
		self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> ( "Awesome! You've created a postcard!" )
	 	);
	 	return self::$notif;
	}

	public static function postcard_upload_failed()
	{
		self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> ( "Whoops! Something went wrong while trying to create your postcard..." )
	 	);
	 	return self::$notif;
	}


/*
 * Admin notification
 */
	public static function not_a_number( $value )
	{
		self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> ( "The value you inserted for " . $value . " is not a number." )
	 	);
	 	return self::$notif;
	}

	public static function max_generated_tokens_exceeded( $max )
	{
		self::$notif = array(
	 		"type" 		=> "error",
	 		"content"	=> ( "You can only generate " . $max . " tokens at a time." )
	 	);
	 	return self::$notif;
	}

	public static function tokens_created( $amount )
	{
		self::$notif = array(
	 		"type" 		=> "success",
	 		"content"	=> ( "Awesome! You just created " . $amount . ( $amount == 1 ? "token." : " tokens!" ) )
	 	);
	 	return self::$notif;
	}
}