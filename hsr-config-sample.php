<?php	
	// Shh... This is secret info. If anyone gets this file we're in big trouble.
	$dbname = ""; // Database database name
	$dbuser = ""; // Database Username
	$dbpass = ""; // Database Password
	$dbhost = "localhost";  // You probably don't need to change this
	
	$hash_padding = ""; // A string used to pad out short strings for md5 encryption
		
	mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_select_db($dbname);

	require('hsr-settings.php');	
?>