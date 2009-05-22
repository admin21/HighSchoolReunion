<?php

/********************************************************
 *	New user registration page. There are links to 		*
 *	this page from the header on every other page for	*
 *	logged-out and logged-in users. This may be a		*
 *	design flaw however; it's entirely possilbe that	*
 *	we may want to show this page only to logged-out	*
 *	visitors.											*
 ********************************************************/

require_once('../hsr-config.php');

if ($_POST['submit'] == 'Mail Confirmation') {
	$feedback = user_register();
	
	// In every case, successful or not, there will be feedback
	$feedback_str = "<p class=\"errormess\">$feedback</p>";
	} else {
	// Show form for the first time
	$feedback_str = '';
	}
	
	// ----------------
	// DISPLAY THE FORM
	// ----------------
	include_once('header_footer2.php');
	site_head('Registration');
	
	// Superglobals don't work with heredoc
	$php_self = $_SERVER['PHP_SELF'];
	
	$first_name = $_POST['first_name'];
	$maiden_name = $_POST['maiden_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];
	$email = $_POST['email'];
	if (!empty($_POST['grad_year2'])) {
		$grad_year = $_POST['grad_year2'];
	} else {
		$grad_year = $_POST['grad_year'];
	}
	
	// 2. Change from table	// 3. Change to a real divider bar image
	
?>

<table cellpading=0 cellspacing=0 border=0 align=center 
		width=621>
	<tr>
		<td rowspan=10><img width=15 height=1
			src="../images/spacer.gif"></td> 
		<td width=606></td>
	</tr>
	<tr>
	<td>
	
	<?php echo $feedback_str ?>
	<p><strong>REGISTER</strong><br />
	Fill out this form and a confirmation email will be sent to you.
	Once you click on the link in the email your account will be
	confirmed and you can begin to contribute to the community.</p>
	<form action="register.php" method="post">
	<p>First Name<br />
	  <input type="text" name="first_name" value="<?php echo $first_name ?>"
		size="20" maxlength="25" />
	</p>
	<p>Maiden Name<br />
		<input name="maiden_name" type="text" id="maiden_name" value="<?php echo $last_name ?>"
		size="20" maxlength="25">
	</p>
	<p>Last Name<br />
		<input type="text" name="last_name" value="<?php echo $last_name ?>"
		size="20" maxlength="25"></p>
	<p>Username<br />
		<input type="text" name="user_name" value="<?php echo $user_name ?>"
		size="10" maxlength="25"></p>
	<p>Graduation Year*<br />
    <?php grad_list_register() ?>
<em><u>or</u></em>
    
<input name="grad_year2" type="text" value="<?php echo $grad_year; ?>" size="5" maxlength="4" />
    <br />
	</p>
	<p>Password<br />
		<input type="password" name="password1" value=""
		size="10" maxlength="25"></p>
	<p>Password<br />
		<input type="password" name="password2" value=""
		size="10" maxlength="25"></p>
	<p>Email <small>(required for confirmation)</small><br />
		<input type="text" name="email" value="<?php echo $email ?>"
		size="30" maxlength="50"></p>	
	<p><input type="submit" name="submit" value="Mail Confirmation">
	</p>
	<p>* <u>Can't find your class?</u> You must be the first from your class! Just type your graduation year in the box. Remember to tell your classmates about us.</p>
	</form>		</td>
	</tr>
	</table>
	
<?php site_footer(); ?>