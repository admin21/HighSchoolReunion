<?php 

include('../hsr-config.php');
global $site_root;

$ref = $_SERVER['HTTP_REFERER'];


switch($ref) {

	case $site_admin . 'hsr-admin/index.php':
	
	header("Location: index.php");
	
	break;
	
	case $site_admin . 'hsr-admin/options.php':
	
	header("Location: options.php");
	
	break;
	
	default:
	
	header("Location: index.php");
	
	break;
	
}

?>