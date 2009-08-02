<?php

	define('NEWHSRADDRESS', 'j@joshbetz.com');
	define('NEWHSRSUBJECT', 'New HSR site');

include('../hsr-config.php');

if (!file_exists('../hsr-config.php')) {
	
	alum_die("It looks like there is no <code>hsr-config.php</code> file. We have to have this file before we start. 
	You probably just forgot to set one up. It's simple, just edit the <code>hsr-config-sample.php</code> file with your
	database information. Then rename it to <code>alum-config.php</code>.", "High School Reunion &rsaquo; Error");
	}

if (!isset($hash_padding) || $hash_padding == "") {

	alum_die("You didn't define a ".'<code>$hash_padding</code>'." in the <code>hsr-config.php</code>. You'll have to go back and put a value in there. It's a security thing. If you don't have a value in there, the passwords are more vulnerable to attack. We're just trying to make sure you stay safe. Thanks!", "High School Reunion &rsaquo; Error");

}
	
	if (isset($_GET['step']))
		$step = $_GET['step'];
	else 
		$step = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo 'High School Reunion &rsaquo; Installation'; ?></title>
	<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<img src="../img/hsr-logo.png" width="250" height="141" />
<?php
// Check if alum is installed.
// create is_alum_installed function
if (is_alum_installed()) die('<h1>Already Installed</h1><p>It appears that you have already installed High School Reunion. Before you reinstall you have to clear the database tables first</p></body></html>');

switch($step) {
	case 0:
?>
<p><?php printf('Welcome the the High School Reunion installation. There are just a few steps for basic setup. You might want to read the <a href="%s">Readme</a>.', '../readme.html'); ?></p>
<h2 class="step"><a href="install.php?step=1"><?php echo 'First Step &raquo;'; ?></a></h2>
<?php
		break;
	case 1:
?>
<h1><?php echo 'First Step'; ?></h1>
<p><?php echo "First we need to get some basic information, but you can always change it later if you need to."; ?></p>

<div class="big-form">
<form id="setup" method="post" action="install.php?step=2">
	<table width="100%">
		<tr>
			<th width="33%"><?php echo 'Alumni Title:'; ?></th>
			<td><input name="alumni_title" type="text" id="alumni_title" size="25" /></td>
		</tr>
		<tr>
			<th><?php echo 'Tagline:'; ?></th>
			<td><input name="tagline" type="text" id="tagline" size="25"  /></td>
		<tr>
			<th><?php echo 'Admin Email:'; ?></th>
			<td><input name="admin_email" type="text" id="alumni_email" size="25" /></td>
		</tr>
		<tr>
			<th><?php echo 'Admin Password:'; ?></th>
			<td><input name="admin_password1" type="password" id="admin_password" size="25"  /></td>
		</tr>
		<tr>
			<th><?php echo 'Admin Password (again):'; ?></th>
			<td><input name="admin_password2" type="password" id="admin_password" size="25"  /></td>
		</tr>
		<tr>
			<th><?php echo 'Site Root:'; ?></th>
			<td><input name="site_root" type="text" id="site_root" size="25"  value="http://" /></td>
		</tr>
		<tr>
			<th><?php echo 'No Reply Email:'; ?></th>
			<td><input name="noreply" type="text" id="noreply" size="25"  /></td>
		</tr>
		</tr>
	</table>
	<input name="priv_policy" type="hidden" value="We promise not to steal your information or sell it to anybody. Nobody will get your info."  />
	<h2 class="step"><input type="submit" name="Submit" value="<?php echo 'Continue to Second Step &raquo;'; ?>" /></h2>
</form>
</div>
<?php
		break;
	case 2:
		// Fill in the data we gathered
		$alumni_title = stripslashes($_POST['alumni_title']);
		$tagline = $_POST['tagline'];
		$admin_email = stripslashes($_POST['admin_email']);
		$pass1 = $_POST['admin_password1'];
		$pass2 = $_POST['admin_password2'];
		$site_root = format_root($_POST['site_root']);
		$noreply = $_POST['noreply'];
		$crypt_pass = md5($pass1.$hash_padding);
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$hash = md5($admin_email.$hash_padding);
		// check e-mail address
		if (empty($admin_email)) {
			die("<strong>ERROR</strong>: please type your e-mail address");
		}
		
		// check that passwords are the same
		if ($pass1 != $pass2) {
			die("<strong>ERROR</strong>: passwords are not the same");
		} else if (strlen($pass1) < 6) {
			die("<strong>ERROR</strong>: the password needs to be at least 6 characters"); 
		}

?>
<h1><?php echo 'Second Step'; ?></h1>
<p><?php echo 'Now we&#8217;re creating the database tables'; ?></p>


<?php

	// Build users table
	$query = "CREATE TABLE users
		(
		user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_name varchar(25) NOT NULL,
		first_name varchar(25) NOT NULL,
		maiden_name varchar(25) NOT NULL,
		last_name varchar(25) NOT NULL,
		grad_year varchar(4) NOT NULL,
		password varchar(50) NOT NULL,
		email varchar(50) NOT NULL,
		status ENUM( 'on', 'off' ) NOT NULL DEFAULT 'on',
		rank ENUM( '1', '2', '3' ) NOT NULL DEFAULT '3', 
		remote_addr varchar(20) NOT NULL,
		confirm_hash varchar(50) NOT NULL,
		is_confirmed varchar(5) NOT NULL,
		date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		address varchar(50),
		city varchar(50),
		state varchar(30),
		country varchar(30) DEFAULT 'United States',
		zip varchar(10),
		home_phone varchar(20),
		cell_phone varchar(20),
		work_phone varchar(20),
		work_ext varchar(10),
		photo varchar(100),
		homepage varchar(100),
		link1 varchar(50),
		link2 varchar(50),
		link3 varchar(50)
		)";
	$result = mysql_query($query);
	
	// Build options table
	$query2 = "CREATE TABLE options
		(
		option_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		option_name varchar(60) NOT NULL,
		option_value longtext NOT NULL,
		option_description tinytext NOT NULL,
		option_date VARCHAR(20)
		)";
	$result2 = mysql_query($query2);
	
	// Insert System Administrator
	$query3 = "INSERT INTO users (user_name, first_name, last_name, maiden_name, grad_year, password, email, status, rank, remote_addr, confirm_hash, is_confirmed, date_created)
               VALUES ('admin', 'System', 'Administrator', '', '0', '$crypt_pass', '$admin_email', 'on', '1', '$user_ip', '$hash', '1', NOW())";
	$result3 = mysql_query($query3);
	
	// Insert Alumni Title
	$query4 = "INSERT INTO options (option_name, option_value, option_description)
				VALUES ('alumni_title', '$alumni_title', 'The title of this section of your site'),
				('tagline', '$tagline', 'Short tagline'),
				('site_root', '$site_root', 'The web address of this section of your site'),
				('noreply', '$noreply', 'An email address used only to send user information'),
				('priv_policy', 'You can have your own privacy policy or delete this', 'The Privacy Policy'),
				('admin_message', '', 'A message from the administrator'),
				('welcome_message', '<p>This is just a sample message. You can change it in a minute.</p>', 'HSR homepage text'),
				('theme', 'default', 'The website theme'),
				('dark_color', '#CC0000', 'The hex value of the dark color for the admin color scheme'),
				('light_color', '#FF0000', 'The hex value of the light color for the admin color scheme'),
				('logo', 'none', 'The name of the img file for the logo'),
				('homepage', 'http://', 'If there is another page you want displayed as the homepage in the links.'),
				('cur_vers', '0.8', 'The current version of High School Reunion. Used for database updates')"; 
	$result4 = mysql_query($query4);
	
	
	// Build posts table
	$query11 = "CREATE TABLE `posts` (
		`id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`post_author` BIGINT( 20 ) NOT NULL ,
		`post_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
		`post_status` ENUM( 'draft', 'review', 'publish' ) NOT NULL,
		`event_class` INT( 4 ) NOT NULL,
		`post_title` TEXT NOT NULL ,
		`post_slug` VARCHAR( 200 ) NOT NULL ,
		`post_content` LONGTEXT NOT NULL ,
		`post_type` ENUM( 'event', 'page' ) NOT NULL DEFAULT 'event',
		`due_date` BIGINT NOT NULL
		)";
	$result11 = mysql_query($query11);
	
	// Build links table
	$query12 = "CREATE TABLE `links` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`name` VARCHAR( 25 ) NOT NULL ,
		`description` VARCHAR( 500 ) NOT NULL ,
		`URL` VARCHAR( 500 ) NOT NULL ,
		`author` INT NOT NULL
		)";
	$result12 = mysql_query($query12);
	
?>
<?php include('../hsr-includes/vars.php'); ?>
<?php mailer(NEWHSRADDRESS, NEWHSRSUBJECT, newhsr_msg($_POST['alumni_title'], $site_root)); ?>
<p><em><?php echo 'Finished!'; ?></em></p>

<p><?php printf('Now you can <a href="%1$s">log in</a> with the <strong>username</strong> "<code>admin</code>".', 'login.php'); ?></p>

<dl>
	<dt><?php echo 'Username'; ?></dt>
		<dd><code>admin</code></dd>
	<dt><?php echo 'Password'; ?></dt>
		<dd><code><?php pass_stars($_POST['admin_password1']); ?></code></dd>
	<dt><?php echo 'Login address'; ?></dt>
		<dd><a href="login.php">login.php</a></dd>
</dl>
<p><?php echo 'That&#8217;s it. Did you think there would be more? Nope, all done!'; ?></p>

<?php
		break;
}
?>

<p id="footer"><?php echo 'High School Reunion'; ?></p>
</body>
</html>