<?php

public class Database {
	public function connectToDatabase($user, $password) {
		session_start();

		/* Define constants */
			define('HOST', 'mysql3.nucleus.be');
			define('USER', $user);
			define('PASS', $password);
			define('DB', 'drumstore2');
			
		
		/* Connects to the MySQL server */
			$con = mysql_connect(HOST, USER, PASS) or die('Access denied: Invalid user or password');
			
			if ($con)
				mysql_select_db(DB) or die(mysql_error());
			else
				echo 'Could not connect to the database:' . mysql_error();
		
	}
}

?>