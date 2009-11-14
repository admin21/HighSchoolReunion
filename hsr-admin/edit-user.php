<?php

include('../hsr-config.php');

$id = $_GET['id'];

$pospage = $_GET['pos'];
$posar = explode(':', $pospage);
$page = $posar[0];
$num = $posar[1];
if($num == 1) $page = $posar[0] - 1;

$ref = $_SERVER['HTTP_REFERER'];

$query = mysql_num_rows(mysql_query("SELECT * FROM users WHERE user_id = '$id' LIMIT 1"));

if($query == 0) header("Location: manage-users.php?page=$page");

include('header_footer.php');

if (user_can(1)) {

site_head('Edit User');

$query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$username = $row['user_name'];
	$firstname = $row['first_name'];
	$maidname = $row['maiden_name'];
	$lastname = $row['last_name'];
	$class = $row['grad_year'];
	$email = $row['email'];
	$rank = $row['rank'];
	$status = $row['status'];
	$ip = $row['remote_addr'];
	$created = $row['date_created'];
	$confirmed = $row['is_confirmed'];
	}
	switch($rank) {
	 	case 1:
		$rank = 'Admin';
		break;
		
	 	case 2:
		$rank = 'Moderator';
		break;
		
	 	case 3:
		$rank = 'User';
		break;

		}
	
	switch($confirmed) {
		case 0:
			$confirmed = 'No';
		break;
		
		case 1:
			$confirmed = 'Yes';
		break;
		}
	
?>

<div id="holder">
<a href="manage-users.php?page=<?php echo $page; ?>">Back to Users</a>
<form action="post.php" method="post">
<div class="left-col">
<p><strong>Username</strong><br />
  <input name="username" type="text" disabled="disabled" value="<?php echo $username; ?>" /></p>
<p><strong>First Name</strong><br />
  <input name="firstname" type="text" value="<?php echo $firstname; ?>" /></p>
<p><strong>Maiden Name</strong><br />
  <input name="maidname" type="text" value="<?php echo $maidname; ?>" /></p>
<p><strong>Last Name</strong><br />
  <input name="lastname" type="text" value="<?php echo $lastname; ?>" /></p>
<p><strong>Class</strong><br />
  <input name="class" type="text" value="<?php echo $class; ?>" /></p>
<p><strong>Email</strong><br />
  <input name="email" type="text" value="<?php echo $email; ?>" /></p>
<p><strong>Rank</strong><br />
  <select name="rank">
  <option value="1">Admin</option>
  <option value="2">Moderator</option>
  <option value="3" selected="selected">User</option>
	</select></p>
<p><strong>Status</strong><br />
  <select name="status">
  <option value="on" selected="selected">On</option>
  <option value="off">Off</option>
	</select></p>
<p><strong>Password</strong><br />
  <input name="password1" type="password" /></p>
<p><strong>Password <em>(again)</em></strong><br />
  <input name="password2" type="password" /></p>
</div>
<div class="left-col">
<p><strong>IP Address</strong><br />
  <?php echo $ip; ?></p>
<p><strong>Date Created</strong><br />
  <?php echo $created; ?></p>
<p><strong>Confirmed</strong><br />
  <?php echo $confirmed; ?></p>
<p><strong>Rank</strong><br />
  <?php echo $rank; ?></p>
<p><strong>Status</strong><br />
  <?php echo $status; ?></p>
<p><a href="javascript:confirmdelete( 'users', '<?php echo siteroot() ?>', '<?php echo $username ?>', '<?php echo $id ?>' )">Delete</a></p>
</div>
<br class="clear" />
<input name="type" type="hidden" value="user-edit" />
<input name="pos" type="hidden" value="<?php echo $pospage; ?>" />
<input name="id" type="hidden" value="<?php echo $id; ?>"  />
<input name="submit" type="submit" value="Save">
</form>
</div>
	
<?php site_footer(); 

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}


?>