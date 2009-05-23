<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Privacy Policy</title>
</head>

<body>
<img src="img/hsr-logo-med.png" alt="" />
<h1>Privacy Policy</h1>
<h2>HSR's Privacy Policy</h2>
<h3>How We Use the Information We Collect</h3>
<p><strong>Information Provided by You</strong> - When you register for an account on HSR we ask for your name, email address, graduation year, and a username. This information will be shown on your profile on the website. We also ask for a password which is known only by you. If your password is lost we cannot help you get it back as it is one-way encrypted before it is stored in our database. After you register you will have the option of providing your phone number, and address along with a number of website URLs. All of this information is optional and will be shown on your profile if you choose to provide that information.</p>
<p><strong>Cookies</strong> - When you login to HSR cookies are stored in your browser to identify your browser. Most browsers are setup to accept cookies, but you can set your browser to refuse all cookies or ask you before cookies are accepted. In order for HSR to be functional we ask that you enable cookies for this site.</p>
<p><strong>Log Information</strong> - Upon registration the user's IP address will be logged. At no time will your IP address given away. This is solely to help the Administrator of this site determine if users are legitimate.</p>
<p><small>Updated: 7/27/2008 | HSR Version .60</small></p>
<?php
include('hsr-config.php');
echo '<h2>'. sitename() . ' Privacy Policy</h2>';
$query = "SELECT option_value FROM options WHERE option_name = 'priv_policy'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$priv = hsrautop($row['option_value']);
	}
	
	echo $priv;
		
?>
</body>
</html>
