<?php

/*******************************************
 * This file displays the forgot-password  *
 * form.  It submits to itself, mails a    *
 * temporary password, and then redirects  *
 * to login.							   *
 *******************************************/
 
require_once('../hsr-config.php');

global $hash_padding;

if ($_POST['command'] == 'forgot' &&
	strlen($_POST['email'] <= 50)) {
	// Handle submission. This is a one-time only form
	// so there will be no problems with handling errors.
	$as_email = addslashes($_POST['email']);
	$query = "SELECT user_id, user_name
			FROM users
			WHERE email = '$as_email'";
	$result = mysql_query($query);
	$is_user = mysql_num_rows($result);
	$results = mysql_fetch_array($result);
	
	if ($is_user == 1) {
		if ($_POST['forgot_type'] == 'username') {
			// Forgot Username
			$username = $results['user_name'];			
			$subject = "Forgotten Username";
			$msg = forgotuname_msg($username);
		} elseif($_POST['forgot_type'] == 'password') {
			// Generate a random password
			$alphanum =
				array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 
				'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E',
				'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U',
				'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9');
			$chars = sizeof($alphanum);
			$a = time();
			$password = mt_srand($a);
			
			for ($i=0; $i < 6; $i++) {
				$randnum = intval(mt_rand(0,60));
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
			
			$subject = "New Password";
			$msg = forgotpword_msg($password);
		}
				
	// Send the email
	$to			= $_POST['email'];
		
	mailer($to, $subject, $msg);
				
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
	<img src="../img/hsr-logo.png" width="250" height="141" alt="High School Reunion" />	</td>
	<td bgcolor="ffffff" align=left valign=top width=83%>
	<h1>Request New Username or Password</h1>
	<p><b>Forgot your username or password?</b> Don't worry -- simply enter your 
		email address below and select username or password, and we will email you 
		a new username or password.</p>
	<p>	<i>Please use the email address you provided when you
		registered.</i></p>
		
	  <form action="<?php echo $php_self; ?>" method="post">
      	<input type="radio" name="forgot_type" value="username" checked="checked" id="forgot-type_0" /> Username
      	<input type="radio" name="forgot_type" value="password" id="forgot-type_1" /> Password
        <br />
      	<input type="text" name="email"> 
		<input type="hidden" name="command" value="forgot">
		<input type="submit" value="Go">
	 </form>
		
		</td>
		</tr>
		</table>
		
<?php site_footer(); ?>