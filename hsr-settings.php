<?php
	
	require('hsr-includes/functions.php');
	require('hsr-includes/vars.php');
	require('hsr-includes/formatting.php');
	require('hsr-includes/pagination.php');
	require('hsr-includes/wordpress.php');
	require('hsr-includes/themes.php');
	
	//Settings
	define('VERSION', '.8'); // HSR Version
	define('BUILDNUMBER', '85'); // Working Beta Build #
	// Remember to increment up after commit
	
	define('DEBUGGING', false); // Are we debugging?
	
	if(DEBUGGING) {
		error_reporting(E_ALL);
	} else {
		error_reporting(E_ALL ^ E_NOTICE);
	}

?>