<?php

function the_title() {

$post = $_GET['p'];

$query = "SELECT post_title FROM posts WHERE id = '$post' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		$title = $row['post_title'];			
		}
	echo $title;
}

function the_entry() {

$post = $_GET['p'];

$query = "SELECT post_content FROM posts WHERE id = '$post' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		$content = hsrautop($row['post_content']);			
		}
	echo $content;
}

function the_date() {

$post = $_GET['p'];

$query = "SELECT post_type, due_date FROM posts WHERE id = '$post' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		$due_date = $row['due_date'];
		$type = $row['post_type'];
		}
	if ($type == 'event') {
		echo date('m/d/y \@ g:i a', $due_date);
	} else {
		echo '';
	}
}

function homepage_link() {
	
	$query = "SELECT option_value FROM options WHERE option_name = 'homepage' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		$link = $row['option_value'];			
		}
	
	if($link != 'http://') {
		echo '<span><a href="'.$link.'" >Home</a></span>';
	}
}

function post_links($home = true) {

if($home) {
echo "<span><a href=\"" . siteroot() . "\">Alumni</a></span>";
}

$query = "SELECT * FROM posts WHERE post_type = 'page'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$id = $row['id'];
	$title = $row['post_title'];
	
echo "<span><a href=\"" . siteroot() . "index.php?p=" . $id . "\">" . $title . "</a></span>";
	
	}

}

function admin_link() {

$username = $_COOKIE['user_name'];
	if (!empty($username)) {
	echo "<a href=\"" . siteroot() . "hsr-admin/\">Dashboard</a>";
	}
}

?>