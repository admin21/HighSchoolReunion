<?php

include('../hsr-config.php');

if (user_can(2) || $_GET['id'] == get_userid()) {

$type = $_GET['type'];

switch($type) {
	case 'posts':

$id = $_GET['id'];

	$query = "DELETE FROM posts WHERE id = '$id'";
	$result = mysql_query($query);
	header("Location: manage-posts.php");
	
	break;
	
	case 'links':
	
$id = $_GET['id'];

	$query = "DELETE FROM links WHERE id = '$id'";
	$result = mysql_query($query);
	header("Location: manage-links.php");
	
	break;
	
	case 'users':
	
$id = $_GET['id'];

	if ($id != 1) {
	$query = "DELETE FROM users WHERE user_id = '$id'";
	$result = mysql_query($query);
	}
	header("Location: manage-users.php");
	
	break;
	
	case 'ownuser':
	
$id = $_GET['id'];

	if ($id !=1) {
	$query = "DELETE FROM users WHERE user_id = '$id'";
	$result = mysql_query($query);
	header("Location: login.php");
	} else {
	header("Location: index.php");
	}
	
	break;
	
	case 'logo':
	$id = $_GET['id'];
	$query = "SELECT option_value FROM options WHERE option_value = '$id' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$logo = $row['option_value'];
	}
	
	if ($id != $logo) {
		$root = '../hsr-content/uploads/logos/';
		$filename = $root . $id;
		unlink($filename);
		header('Location: logo.php');
	} else {
		echo 'Sorry, that logo is in use. Please select a new logo to use or none before you try again';
	}
	
	break;
	
}
?>
<?php 
} else {
echo "You're not allowed to do that!";
} 
?>