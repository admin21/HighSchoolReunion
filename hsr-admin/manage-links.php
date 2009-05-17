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

$offset = 10 * ($page - 1);

?>

		
<?php 
	
function next_last($last_text, $next_text) {
global $offset, $page, $result;

$query = "SELECT * FROM links ORDER BY id DESC LIMIT $offset,11";
$result = mysql_query($query);

	$next = $page + 1;
	$last = $page - 1;
	if ($page == 1 && mysql_num_rows($result) > 10) {
		echo "<a href=\"manage-links.php?page=" . $next . "\">" . $next_text . "</a>";
	} elseif ($page != 1 && mysql_num_rows($result) <= 10) {
		echo "<a href=\"manage-links.php?page=" . $last . "\">" . $last_text . "</a>";
	} elseif (mysql_num_rows($result) > 10) {
		echo "<a href=\"manage-links.php?page=" . $last . "\">" . $last_text . "</a>  <a href=\"manage-links.php?page=" . $next . "\">" . $next_text . "</a>";
	} else {
		echo "";
	}
}
	

global $page, $offset;
linknav(); ?>
<div id="holder">
<div class="post-management">	
<script src="../hsr-includes/js/list-edit.js" type="text/javascript"></script>
<h2>Manage Links</h2>
<table class='manage'>
<tr>
<th>ID</th>
<th>Title</th>
<th>URL</th>
<th>Description</th>
<th></th>
<th></th>
</tr>
<?php 
		/* This variable is for alternating comment background */		
		$oddcomment = '"alt"';
				

$query = "SELECT * FROM links ORDER BY id DESC LIMIT $offset,10";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	  /* Changes every other comment to a different class */	  
	  if ('"alt"' == $oddcomment) $oddcomment = '""';
	  else $oddcomment = '"alt"';
  
	 $id = $row['id'];
	 $title = $row['name'];
	 $description = $row['description'];
	 $url = $row['URL'];
	 
	 // Fixes long titles
	 if (strlen($title) > 20) {
		$title2 = substr($title, 0, 19) . "...";
	 } else {
	 	$title2 = $title;
	 }
	 
	 // Fixes long titles
	 if (strlen($url) > 20) {
		$url2 = substr($url, 0, 19) . "...";
	 } else {
	 	$url2 = $url;
	 }
	 
	 // Fixes long titles
	 if (strlen($description) > 20) {
		$description2 = substr($description, 0, 19) . "...";
	 } else {
	 	$description2 = $description;
	 }
	 ?>
	 
	  <tr class="<?php $oddcomment ?>">
	  <td><?php echo $id ?></td>
	  <td><?php echo $title2 ?></td>
	  <td><?php echo $url2 ?></td>
	  <td><?php echo $description2 ?></td>
	  <td><a href="<?php echo siteroot() ?>hsr-admin/edit-link.php?id=<?php echo $id ?>">Edit</a></td>
	  <td><a href="javascript:confirmdelete( 'links', '<?php echo siteroot(); ?>', '<?php echo $title ?>', '<?php echo $id ?>' )">Delete</a></td>
	  </tr>
<?php	} ?>

</table>

<?php
next_last('&laquo; Previous Page', 'Next Page &raquo;');

//pagination
$query = "SELECT * FROM links";
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



