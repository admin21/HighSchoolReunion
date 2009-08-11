<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(1)) {

site_head('Manage Users');

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

$query = "SELECT * FROM users ORDER BY user_id LIMIT $offset,11";
$result = mysql_query($query);

	$next = $page + 1;
	$last = $page - 1;
	if ($page == 1 && mysql_num_rows($result) > 10) {
		echo "<a href=\"manage-users.php?page=" . $next . "\">" . $next_text . "</a>";
	} elseif ($page != 1 && mysql_num_rows($result) <= 10) {
		echo "<a href=\"manage-users.php?page=" . $last . "\">" . $last_text . "</a>";
	} elseif (mysql_num_rows($result) > 10) {
		echo "<a href=\"manage-users.php?page=" . $last . "\">" . $last_text . "</a>  <a href=\"manage-users.php?page=" . $next . "\">" . $next_text . "</a>";
	} else {
		echo "";
	}
}

global $page, $offset;
usernav(); ?>
<div id="holder">
<div class="post-management">	
<script src="../hsr-includes/js/list-edit.js" type="text/javascript"></script>
<h2>Manage Users</h2>
<table class='manage'>
<tr>
<th>ID</th>
<th>Username</th>
<th>First Name</th>
<th>Last Name</th>
<th>Class</th>
<th>Rank</th>
<th>Status</th>
<th></th>
<th></th>
</tr>
<?php	
		/* This variable is for alternating comment background */		
		$oddcomment = '"alt"';
				

$query = "SELECT * FROM users ORDER BY user_id LIMIT $offset,10";
$result = mysql_query($query);
$num = mysql_num_rows($result);
while($row = mysql_fetch_array($result))
	{
	  /* Changes every other comment to a different class */	  
	  if ('"alt"' == $oddcomment) $oddcomment = '""';
	  else $oddcomment = '"alt"';
  
	 $id = $row['user_id'];
	 $username = $row['user_name'];
	 $firstname = $row['first_name'];
	 $lastname = $row['last_name'];
	 $class = $row['grad_year'];
	 $rank2 = $row['rank'];
	 $status = $row['status'];
	 
	 switch($rank2) {
	 	case 1:
		$rank = 'Admin';
		break;
		
	 	case 2:
		$rank = 'Editor';
		break;
		
	 	case 3:
		$rank = 'User';
		break;

		}
?>		
	 
	  <tr class="<?php echo $oddcomment?>">
	  <td><?php echo $id ?></td>
	  <td><?php echo $username ?></td>
	  <td><?php echo $firstname ?></td>
	  <td><?php echo $lastname ?></td>
	  <td><?php echo $class ?></td>
	  <td><?php echo $rank ?></td>
	  <td><?php echo $status ?></td>
	  <td><a href="<?php echo siteroot() ?>hsr-admin/edit-user.php?id=<?php echo $id ?>&pos=<?php echo $page; ?>:<?php echo $num; ?>">Edit</a></td>
	  <td><a href="javascript:confirmdelete( 'users', '<?php echo siteroot() ?>', '<?php echo $username ?>', '<?php echo $id ?>' )">Delete</a></td>
	  </tr>
<?php	} ?>

</table>
<?php
//pagination
$query = "SELECT * FROM users";
$result = mysql_query($query);
$num = mysql_num_rows($result);
$total = ceil($num/10);
echo pagination_four($total, $page);
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