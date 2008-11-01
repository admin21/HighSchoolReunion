<?php

require('hsr-config.php'); 

$query = "SELECT * FROM options WHERE option_name = 'theme'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$theme = $row['option_value'];
	}

if (isset($_GET['p'])) {
	$p = $_GET['p'];
$include = "hsr-content/themes/".$theme."/page.php";
	include($include);
	
	$query = "SELECT * FROM posts WHERE id = '$p' LIMIT 1";
	$result = mysql_query($query);
		
} else {

	$include = "hsr-content/themes/".$theme."/index.php";
	include($include);

}
?>