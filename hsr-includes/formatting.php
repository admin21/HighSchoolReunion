<?php

//Add a trailing slash to home directories
//if they didn't put one in
function format_root($url) {
	if($url == '' || $url == '/') {
	 $dir = "http://";
	} else {
		$last = substr($url, -1, 1);
		if($last != '/') {
			$dir = $url . '/';
		} else {
			$dir = $url;
		}
	}
	return $dir;
}
	
//CSS Colors
function get_darkcolor() {
	$query = "SELECT option_value FROM options WHERE option_name = 'dark_color' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$dark = $row['option_value'];
		}
	return $dark;
}
	
function get_lightcolor() {
	$query = "SELECT option_value FROM options WHERE option_name = 'light_color' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$light = $row['option_value'];
		}
	return $light;
}
	
?>
