<?php
	
	require('hsr-includes/functions.php');
	require('hsr-includes/vars.php');
	require('hsr-includes/formatting.php');
	require('hsr-includes/pagination.php');
	require('hsr-includes/wordpress.php');
	require('hsr-includes/themes.php');
	
	//Settings
	define('VERSION', '.8'); // HSR Version
	define('BETABUILD', true); // is this a beta?
	define('BUILDNUMBER', '79'); // HSR Build Number
	
	define('DEBUGGING', false);
	
	if(DEBUGGING) {
		error_reporting(E_ALL);
	} else {
		error_reporting(E_ALL ^ E_NOTICE);
	}

?>