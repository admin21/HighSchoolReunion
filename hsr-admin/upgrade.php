<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>High School Reunion Upgrades</title>
<?php include("../hsr-config.php"); ?>

<?php
	if (isset($_GET['p'])) {
		$page = $_GET['p'];
	} else {
		$page = 'check';
	}
?>
</head>
<body>

<?php switch($page) {
	
	case 'check':
	if(hsr_isupdated(CURVERS)) header("Location: upgrade.php?p=uptodate");
	else header("Location: upgrade.php?p=upgrades");
	break;
	
	case 'uptodate':
?>
	<h1>Up to Date</h1>
	<p>It looks like you're already up to date. <a href="index.php">Continue</a>.</p>

<?php
	
	break;
	case 'upgrade':

?>
	<h1>Upgrading Database</h1>
	
	<p>Performing Updades</p>

<?php hsr_update_dbase(); ?>

	<p>That's it! You're all done. <a href="index.php">Continue</a>.</p>
	
<?php
	break;
}
?>
</body>
</html>
	
<?php

function hsr_update_dbase() {

	$sql = mysql_fetch_array(mysql_query("SELECT option_value FROM options WHERE option_name = 'cur_vers' LIMIT 1"));
	$cur_vers = $sql['option_value'];

	// It should be 0.8, not .80
	if($cur_vers == '.80') mysql_query("UPDATE  options SET  option_value =  '0.8' WHERE  option_name = 'cur_vers' LIMIT 1");

	// Array of Database Updates
	$updates = array(
		'0.8' 	=> 	"INSERT INTO options (`option_name`, `option_value`, `option_description`) 
			VALUES ('homepage', 'http://', 'If there is another page you want displayed as the homepage in the links.'),
			('cur_vers', '0.8', 'The current version of High School Reunion. Used for database updates')"
		);
	
	// Sort the updates, just in case, so they are applied in order
	asort($updates);
	
	// Apply the updates from every database version before this one
	foreach($updates as $vers => $query) {
		if($vers < $cur_vers) mysql_query($query);
	}
}

function hsr_isupdated($cur_vers) {

	$sql = mysql_fetch_array(mysql_query("SELECT option_value FROM options WHERE option_name = 'cur_vers' LIMIT 1"));
	$vers = $sql['option_value'];
	$cur_vers = CURVERS;
	
	if($vers == $cur_vers) return true;
	else return false;
}

?>