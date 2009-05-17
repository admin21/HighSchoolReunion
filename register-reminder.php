<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

include('hsr-config.php');

$go = false;

if ($go) {

$query = "SELECT * FROM users WHERE is_confirmed = '0'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$email = $row['email'];
	$hash = $row['confirm_hash'];
	$encoded_email = urlencode($email);
	$link = siteroot() . 'hsr-admin/confirm.php?hash=' . $hash . '&email=' . $encoded_email;
	$noreply = noreply();
	$site_name = sitename();
	$mail_body = <<<EOMAILBODY
Remember, you registered at $site_name. You cannot use this service
until you confirm your email address. Click this link to confirm 
your registration.

$link

Once you see a confirmation message, you will be logged into
$site_name.
EOMAILBODY;
		mail ("$email", "$site_name Registration Confirmation",
			"$mail_body", "From:$noreply");
	}		
}
?>


</body>
</html>
