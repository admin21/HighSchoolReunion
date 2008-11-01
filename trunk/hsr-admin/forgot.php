<?php

/*******************************************
 * This file displays the forgot-password  *
 * form.  It submits to itself, mails a    *
 * temporary password, and then redirects  *
 * to login.							   *
 *******************************************/
 
require_once('../hsr-config.php');

global $hash_padding, $noreply, $site_root;

if ($_POST['command'] == 'forgot' &&
	strlen($_POST['email'] <= 50)) {
	// Handle submission. This is a one-time only form
	// so there will be no problems with handling errors.
	$as_email = addslashes($_POST['email']);
	$query = "SELECT user_id 
			FROM users
			WHERE email = '$as_email'";
	$result = mysql_query($query);
	$is_user = mysql_num_rows($result);
	
	if ($is_user == 1) {
		// Generate a random password
		$alphanum =
	array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 
		'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '2', '3', '4', '5', 
		'6', '7', '8', '9');
			$chars = sizeof($alphanum);
			$a = time();
			mt_srand($a);
			for ($i=0; $i < 6; $i++) {
				$randnum = intval(mt_rand(0,56));
				$password .= $alphanum[$randnum];
			}
			// One-way encrypt it
			$crypt_pass = md5($password.$hash_padding);
			
			// Put the temp password in the db
			$query = "UPDATE users 
					SET password = '$crypt_pass'
					WHERE email = '$as_email'";
			$result = mysql_query($query) or die('Cannot complete
				update');
				
			// Send the email
			$to			= $_POST['email'];
			$from		= $noreply;
			$subject	= "New Password";
			$msg		= <<<EOMSG
		You recently requested that we send you a new password for
		$site_name.  Your new password is:
		
				$password
				
		Please log in at this URL:
		
				$site_root.hsr-admin/login.php'
		
EOMSG;
		
			$mailsend = mail("$to", "$subject", "$msg", "From:$noreply");
				
			// Redirect to login
			header("Location: login.php");
		} else {
			// The email address isn't good, they lose.
		}
		
	}
	
	
	// -----------------------
	// Display the form nicely
	// -----------------------
	
	// Superglobal arrays don't work in heredoc
	$php_self = $_SERVER['PHP_SELF'];
	include('header_footer2.php');
	site_head('Forgot Password');
?>
	<table border=0 cellpadding=10 width="100%">		
	<tr>
	<td align=center valign=top width=260>
	<img src="../img/hsr-logo-med.png" alt="High School Reunion" />	</td>
	<td bgcolor="ffffff" align=left valign=top width=83%>
	<h1>Request new password</h1>
	<p><b>Forgot your password?</b> Don't worry -- simply enter your
		email address below, and we will email you a new password.</p>
	<p>	<i>Please use the email address you provided when you
		registered.</i></p>
		
	  <form action="<?php echo $php_self; ?>" method="post">
		<input type="text" name="email"> 
		<input type="hidden" name="command" value="forgot">
		<input type="submit" value="Send Password">
		</form>
		
		</td>
		</tr>
		</table>
		
<?php site_footer(); ?>