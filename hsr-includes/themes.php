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

?>