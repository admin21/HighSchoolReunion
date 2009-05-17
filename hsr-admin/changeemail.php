<?php

/****************************
 * Change email form page.  *
 ****************************/
 
require_once('../hsr-includes/emailpass_funcs.php');
require_once('../hsr-includes/login_funcs.php');
require_once('../hsr-includes/register_funcs.php');
if (!user_isloggedin()) {
	header("Location: index.php");
}

if ($_POST['submit'] == "Change my Email") {
	$worked = user_change_email();
	if ($worked == 1) {
		$feedback_str = '<p class="errormess">A confirmation email has been sent to you | <a href="index.php">Back</a></p>';
		} else {
			$feedback_str = "<p class \"errormess\">$feedback</p>";
		}
	}
	
	// ------------
	// DISPALY FORM
	// ------------
	
	include_once('header_footer2.php');
	site_head('Change Email');
	
	// Superglobals don't work with heredoc
	$php_self = $_SERVER['PHP_SELF'];
?>

	<table>
	<tr>
	<td width=260>
	<img src="../img/hsr-logo-med.png" alt="High School Reunion" title="High School Reunion"/>	</td>
<td>
		<?php echo $feedback_str; ?>
		<div id="admin-hold">
		<p class=left><strong>Change your Email Address</strong><br />
		A confirmation email will be sent to you.<br />
		<form action="<?php echo $php_self; ?>" method="post">
		<strong>Password</strong><br />
		<input type="password" name="password" value="" size="10"
			maxlenth="15"><br /><br />
		<strong>New email</strong> (required for confirmation)<br />
		<input type="text" name="new_email" value="" size="20"
			maxlength="35"><br /><br />
		<input type="submit" name="submit" value="Change my Email">
		</form>
		</div>
		</td>
		</td>
		</table>
		
<?php site_footer(); ?>