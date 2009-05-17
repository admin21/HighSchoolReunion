<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(2)) {

site_head('Manage Posts');

if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$offset = 10 * ($page -1);

?>

		
<?php 
	
function next_last($last_text, $next_text) {
global $offset, $page, $result;

$query = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset,11";
$result = mysql_query($query);

	$next = $page + 1;
	$last = $page - 1;
	if ($page == 1 && mysql_num_rows($result) > 10) {
		echo "<a href=\"manage-posts.php?page=" . $next . "\">" . $next_text . "</a>";
	} elseif ($page != 1 && mysql_num_rows($result) <= 10) {
		echo "<a href=\"manage-posts.php?page=" . $last . "\">" . $last_text . "</a>";
	} elseif (mysql_num_rows($result) > 10) {
		echo "<a href=\"manage-posts.php?page=" . $last . "\">" . $last_text . "</a>  <a href=\"manage-posts.php?page=" . $next . "\">" . $next_text . "</a>";
	} else {
		echo "";
	}
}

?>
<?php postnav(); ?>
<div id="holder">
<div class="post-management">	
<script src="../hsr-includes/js/list-edit.js" type="text/javascript"></script>
<h2>Manage Posts</h2>
<table class='manage'>
<tr>
<th>ID</th>
<th width='300px'>Title</th>
<th>Type</th>
<th>Date</th>
<th>Author</th>
<th>Status</th>
<th></th>
<th></th>
<th></th>
</tr>
<?php	
		/* This variable is for alternating comment background */		
		$oddcomment = '"alt"';
				

$query = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset,10";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	  /* Changes every other comment to a different class */	  
	  if ('"alt"' == $oddcomment) $oddcomment = '""';
	  else $oddcomment = '"alt"';
  
	 $id = $row['id'];
	 $type = $row['post_type'];
	 if ($type=='event') {
	 	 $date = date('m/d/Y', $row['due_date']);
	 } else {
	 	$date = "-";
	 }
	 $title2 = $row['post_title'];
	 // Fixes long titles
	 if (strlen($title2) > 40) {
		$title = substr($row['post_title'], 0, 39) . "...";
	 } else {
	 	$title = $row['post_title'];
	 }
	 $author = $row['post_author'];
	 $status = $row['post_status'];
?> 
	  <tr class="<?php echo $oddcomment ?>">
	  <td><?php echo $id ?></td>
	  <td><?php echo $title ?></td>
	  <td><?php echo $type ?></td>
	  <td><?php echo $date ?></td>
	  <td><?php echo $author; ?></td>
      <td><?php echo $status; ?></td>
	  <td><a href="<?php echo siteroot() ?>index.php?p=<?php echo $id ?>">View</a></td>
	  <td><a href="<?php echo siteroot() ?>hsr-admin/edit-post.php?id=<?php echo $id ?>">Edit</a></td>
	  <td><a href="javascript:confirmdelete( 'posts', '<?php echo siteroot() ?>', '<?php echo $title ?>', '<?php echo $id ?>' )">Delete</a></td>
	  </tr>
<?php	} ?>

</table>
<?php
next_last('&laquo; Previous Page', 'Next Page &raquo;');

//pagination
$query = "SELECT * FROM posts";
$result = mysql_query($query);
$num = mysql_num_rows($result);
$total = $num/10;
echo pagination_one($total, $page);

?>
</div>
</div>
<?php
site_footer();

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}

?>