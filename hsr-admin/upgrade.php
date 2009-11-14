<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>High School Reunion Upgrades</title>

<style type="text/css">
html {
	background: #EFEFEF;
}
a {
	color: #FF0000;
}
body {
	background: #fff;
	margin: 22px auto;
	width: 744px;
	padding: 22px;
	text-align: center;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #464646;
	-moz-border-radius: 20px;
	-khtml-border-radius: 20px;
	-webkit-border-radius: 20px;
	border-radius: 20px;
}
p {
	font-size: 2em;
	font-weight: normal;
}
h1 {
	font-size: 8em;
	margin: 0 0 .4em 0;
	font-weight: normal;
	color: #333;
}
</style>

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

<?php
	
	switch($page) {
	
	case 'check':
	if(hsr_isupdated(CURVERS)) {
?>
		<h1>Up to Date</h1>
		<p>It looks like you're already up to date. <a href="index.php">Continue</a>.</p>
<?php
	} else { 
?>
	<h1>Out of Date</h1>
	<p>It looks like you have to upgrade the database. <a href="upgrade.php?p=upgrade">Continue</a>.</p>
	
<?php
	}
	
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