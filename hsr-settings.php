<?php
	
	require('hsr-includes/formatting.php');
	require('hsr-includes/functions.php');
	require('hsr-includes/mailer.php');
	require('hsr-includes/pagination.php');
	require('hsr-includes/themes.php');
	require('hsr-includes/vars.php');
	require('hsr-includes/wordpress.php');
	require('hsr-includes/avatars.php');
	
	
	//Settings
	define('VERSION', '0.9'); // HSR Version
	define('CURVERS', '0.8'); // Current Database version
	define('BUILDNUMBER', '139'); // Working Beta Build #
	// Remember to increment up after commit
	
	define('DEBUGGING', false); // Are we debugging?
	
	if(DEBUGGING) {
		error_reporting(E_ALL);
	} else {
		error_reporting(E_ALL ^ E_NOTICE);
	}

?>