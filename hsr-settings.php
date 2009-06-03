<?php
	
	require('hsr-includes/formatting.php');
	require('hsr-includes/functions.php');
	require('hsr-includes/mailer.php');
	require('hsr-includes/pagination.php');
	require('hsr-includes/themes.php');
	require('hsr-includes/vars.php');
	require('hsr-includes/wordpress.php');
	
	
	//Settings
	define('VERSION', '0.8.1'); // HSR Version
	define('BUILDNUMBER', '119'); // Working Beta Build #
	// Remember to increment up after commit
	
	define('DEBUGGING', true); // Are we debugging?
	
	if(DEBUGGING) {
		error_reporting(E_ALL);
	} else {
		error_reporting(E_ALL ^ E_NOTICE);
	}

?>