<?php

$query = "SELECT option_value FROM options WHERE option_name = 'alumni_title' LIMIT 1";
$result = mysql_query($query);

if($result):

// Site Name
function sitename() {
	$query = "SELECT option_value FROM options WHERE option_name = 'alumni_title' LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
  	$site_name = $row['option_value'];

  	return $site_name;
}
  	
// Site root
function siteroot() {
	$query = "SELECT option_value FROM options WHERE option_name = 'site_root' LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
  	$site_root = $row['option_value'];
  	
  	return $site_root;
}
	
// No reply Email Address
function noreply() {
	$query = "SELECT option_value FROM options WHERE option_name = 'noreply' LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
  	$noreply = $row['option_value'];
  	
  	return $noreply;
}

function adminemail() {
	$query = "SELECT email FROM users WHERE user_id = '1' LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
  	$mail = $row['email'];
  	
  	return $mail;
}
		
// User Info
function get_userinfo($type = 'user_name', $username = 'curuser') {
	
	if($username == 'curuser') $user_name = $_COOKIE['user_name'];
	else $user_name = $username;
	
	$query = "SELECT user_id, first_name, last_name, grad_year, email, address, city, state, zip, home_phone, cell_phone, work_phone, work_ext, photo, homepage, link1, link2, link3
			FROM users
			WHERE user_name = '$user_name'";
			
	$result = mysql_query($query);
	$user_array = mysql_fetch_array($result);
	$info = array(
		'user_name' 		=> 		$user_name,
		'id'				=>		$user_array['user_id'],
		'first_name' 		=> 		$user_array['first_name'],
		'last_name' 		=> 		$user_array['last_name'],
		'grad_year' 		=> 		$user_array['grad_year'],
		'email'				=>		$user_array['email'],
		'address'	 		=> 		stripslashes($user_array['address']),
		'city' 				=> 		stripslashes($user_array['city']),
		'state' 			=> 		stripslashes($user_array['state']),
		'zip' 				=> 		stripslashes($user_array['zip']),
		'home_phone' 		=> 		stripslashes($user_array['home_phone']),
		'cell_phone' 		=> 		stripslashes($user_array['cell_phone']),
		'work_phone' 		=> 		stripslashes($user_array['work_phone']),
		'work_ext' 			=> 		stripslashes($user_array['work_ext']),
		'photo_url' 		=> 		urldecode($user_array['photo']),
		'photo_url' 		=> 		stripslashes($photo_url),
		'homepage_url' 		=> 		urldecode($user_array['homepage']),
		'homepage_url' 		=> 		stripslashes($homepage_url),
		'fav_link1' 		=> 		urldecode($user_array['link1']),
		'fav_link1' 		=> 		stripslashes($fav_link1),
		'fav_link2' 		=> 		urldecode($user_array['link2']),
		'fav_link2' 		=> 		stripslashes($fav_link2),
		'fav_link3' 		=> 		urldecode($user_array['link3']),
		'fav_link3' 		=> 		stripslashes($fav_link3)
		);
	
	return $info[$type];
}

endif;

?>