<?php

/**************************************************
 * Login page.  There are links to this page from *
 * the header on every other page for logged-out  *
 * users only.									  *
 **************************************************/
 
require_once('../hsr-includes/login_funcs.php');
require_once('../hsr-config.php');

// If they're logged in, log them out
// They shouldn't be able to see this page logged-in
// This allows the same page to be used as a logout script
if ($LOGGED_IN = user_isloggedin()) {
	user_logout();
	$_COOKIE['user_name'] = '';
	unset($LOGGED_IN);
}

if ($_POST['submit'] == 'Login') {
	if (strlen($_POST['user_name']) <= 25 &&
strlen($_POST['password']) <= 25) {
	$feedback = user_login();
} else {
	$feedback = 'ERROR: Username and password are too long';
}
if ($feedback == 1) {
	// On successful login, redirect to homepage
	header("Location: ../hsr-admin/");
} else {
	$feedback_str = "<p class =\"errormess\">$feedback</p>";
}
} else {
	$feedback_str = '';
}

// ----------------
// DISPLAY THE FORM
// ----------------
include_once('header_footer2.php');
site_head('Login');

$php_self = $_SERVER['PHP_SELF'];

?>


<div class="big-form">
<div id="admin-hold">
<div id="login-form">
<div id="spacer"></div>
<center><img src="../img/hsr-logo-med.png" /></center>
<?php echo $feedback_str; ?>
<h3>Login</h3>
<form action="<?php echo $php_self; ?>" method="post">
<p>Username<br />
<input type="text" name="user_name" value="" /></p>
<p>Password<br />
<input type="password" name="password" value="" /></p>
<p align="right"><input type="submit" name="submit" value="Login" /></p>
</form>

</div>
<div id="login-help">
<p class="login-links"><a href="../index.php">Back to <?php echo $site_name; ?></a><br />
<a href="forgot.php">Forgot your Password?</a><br />
<a href="register.php">New User?</a></p>
</div>
</div>
</div>

<?php site_footer(); ?>