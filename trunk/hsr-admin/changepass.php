<?php

/******************************
 * Change password form page. *
 ******************************/
 
require_once('../hsr-includes/emailpass_funcs.php');
require_once('../hsr-includes/login_funcs.php');
require_once('../hsr-includes/register_funcs.php');
if (!user_isloggedin()) {
	header("Location: index.php");
}

if ($_POST['submit'] == "Change my Password") {
	$worked = user_change_password();
	if ($worked == 1) {
		$feedback_str = '<p class="errormess">Password changed | <a href="index.php">Back</a></p>';
		} else {
			$feedback_str = '<p class="errormess">' . user_change_password() . '</p>';
		}
	}
	
	// ------------
	// DISPLAY FORM
	// ------------
	
	include_once('header_footer2.php');
	site_head('Change Password');
	
	// Superglobals don't work with heredoc
	$php_self= $_SERVER['PHP_SELF'];
?>

	<table>
	<tr>
	<td width=260>
	<img src="../img/hsr-logo.png" width="250" height="141" alt="High School Reunion" title="High School Reunion" />	</td>
<td>
		<?php echo $feedback_str; ?>
		<div id="admin-hold">
		<p class=left><strong>Change your password</strong><br />
		<form action="<?php echo $php_self; ?>" method="post">
		<strong>Old password</strong><br />
		<input type="password" name="old_password" value="" size="10"
			maxlength="15"><br /><br />
		<strong>New Password</strong><br />
		<input type="password" name="new_password1" value="" size="10"
			maxlength="15"><br /><br />
		<strong>New Password</strong> (again)<br />
		<input type="password" name="new_password2" value-"" size="10"
			maxlength="15"><br /><br />
		<input type="submit" name="submit" value="Change my Password">
		</form>
		</div>
		</td>
		</td>
		</table>

<?php site_footer(); ?>