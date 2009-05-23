<?php

function mailer($to, $subject, $body, $from = 'noreply') {
	if($from == 'noreply') $from = "High School Reunion <" . noreply() . ">";
	$headers = "From: $from\r\n";
	$headers .= "Content-type: text/html\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion();
	
	mail("$to", "$subject", "$body", "$headers");

}

function reg_msg($email) {
	global $hash_padding;
	
	$hash = md5($email.$hash_padding);
	$encoded = urlencode($email);
	$link = siteroot() . 'hsr-admin/confirm.php?hash=' . $hash . '&email=' . $encoded;
	$site_name = sitename();
	$body = <<<EOMAILBODY
<html>
<body>
<p>Thank you for registering at $site_name. Click this link
to confirm your registration.</p>

<p><a href="$link">$link</a></p>
</body>
</html>
EOMAILBODY;
	
	return $body;
}

function newemail_msg($email) {
	global $hash_padding;
	
	$hash = md5($email.$hash_padding);
	$encoded = urlencode($email);
	$link = siteroot() . 'hsr-admin/confirm.php?hash=' . $hash . '&email=' . $encoded;
	$site_name = sitename();
	$body = <<<EOMAILBODY
<html>
<body>
<p>Our records show that you recently requested to link 
a new email address with your account at $site_name. If 
this is true, please click the link below. If this is not 
true, you can ignore this message.</p>

<p><a href="$link">$link</a></p>

<p><strong>Note:</strong> If you did not send this request, 
we recommend that you change your password immediately, as 
your account may have been compromised.</p>
</body>
</html>
EOMAILBODY;
	
	return $body;
}

function newevent_msg($id) {
	$query = "SELECT post_author FROM posts WHERE id = '$id' LIMIT 1";
	$result = mysql_fetch_array(mysql_query($query));
	$userid = $result['post_author'];
	$query = "SELECT user_name, first_name, last_name FROM users WHERE user_id = '$userid' LIMIT 1";
	$result = mysql_fetch_array(mysql_query($query));
	$name = $result['first_name'] . ' ' . $result['last_name'];
	$username = $result['user_name'];
	$site_name = sitename();
	$link = siteroot() . 'hsr-admin//edit-post.php?id='.$id;
	$body = <<<EOMAILBODY
<html>
<body>
<p>$name ($username) just added an event on $site_name. To view and approve 
the post to be published visit the link below:</p>

<p><a href="$link">$link</a></p>
</body>
</html>
EOMAILBODY;
	
	return $body;
}


function forgotuname_msg($username) {
	$link = siteroot()."hsr-admin/login.php";
	$site_name = sitename();
	$body = <<<EOMSG
<html>
<body>
<p>
You recently requested that we send your username for
$site_name.  Your new username is:</p>

		<p><strong>$username</strong></p>
		
<p>Please log in at this URL:</p>

		<p>$link</p>
</body>
</html>	
EOMSG;

	return $body;
	
}

function forgotpword_msg($password) {

	$link = siteroot()."hsr-admin/login.php";
	$site_name = sitename();
	$body = <<<EOMSG
<html>
<body>
<p>
You recently requested that we send you a new password for
$site_name.  Your new password is:</p>

<p><strong>$password</strong></p>
		
<p>Please log in at this URL:</p>

<p><a href="$link">$link</a></p>

<p><strong>Note:</strong> We recommend that you login as soon
as possible and change your password.</p>
</body>
</html>		
EOMSG;

	return $body;
	
}

?>