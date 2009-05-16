<?php

require_once('../hsr-config.php');

function user_register() {
	// This function will only work with superglobal arrays,
	// because I'm not passing in any values or declaring globals
	global $hash_padding, $site_name, $site_root, $noreply;

if (!empty($_POST['grad_year2'])) {
	$grad_year = $_POST['grad_year2'];
} else {
	$grad_year = $_POST['grad_year'];
}
	if ($grad_year < date('Y', time()) + 1) {
	// Are all vars present and passwords match?
	if (strlen($_POST['user_name']) <= 25 &&
		strlen($_POST['password1']) <= 25 && ($_POST['password1'] ==
		$_POST['password2']) && strlen($_POST['email']) <= 50 && 
		validate_email($_POST['email'])) {
			// Valiate username and password
		if (account_namevalid($_POST['user_name']) ||
		strlen($_POST['password1'] >= 6)) {

     			$user_name = strtolower($_POST['user_name']);
      			$user_name = trim($user_name); 
				// Don't need to escape, because single quotes
				// aren't allowed
				$email = $_POST['email'];
				// Don't allow duplicate usernames or emails
				$query1 = "SELECT user_id
						FROM users
						WHERE user_name = '$user_name'";
				$result1 = mysql_query($query1);
				$query2 = "SELECT user_id
						FROM users
						WHERE email = '$email'";
				$result2 = mysql_query($query2);
				if ($result1 && mysql_num_rows($result1) > 0) {
				$feedback = 'ERROR: Username Already Exists';
				return $feedback;
				} elseif ($result2 && mysql_num_rows($result2) > 0) {
				$feedback = 'ERROR: Email Address Already Exists';
				return $feedback;
	
			} else {
				$user_name = $_POST['user_name'];
				$first_name = $_POST['first_name'];
				$maiden_name = $_POST['maiden_name'];
				$last_name = $_POST['last_name'];
				if (!empty($_POST['grad_year2'])) {
					$grad_year = $_POST['grad_year2'];
				} else {
					$grad_year = $_POST['grad_year'];
				}
				$password = md5($_POST['password1'].$hash_padding);  // Fix to include md5 or some other type of encyption
				$user_ip = $_SERVER['REMOTE_ADDR'];
				$email = $_POST['email'];
				// Create a new hash to insert into the db and
				// the confirmation email
				$hash = md5($email.$hash_padding); 

     $query = "INSERT INTO users (user_name, first_name, maiden_name, last_name, grad_year, password, email, status, rank, remote_addr, confirm_hash, is_confirmed, date_created)
               VALUES ('$user_name', '$first_name', '$maiden_name', '$last_name', '$grad_year', '$password', '$email', 'on', '3', '$user_ip', '$hash', '0', NOW())"; 
			   
				$result = mysql_query($query); 
				if (!$result) {
					$feedback = 'ERROR: Database error';
					return $feedback;
				} else {
					// Send the confirmation email
					$encoded_email = urlencode($_POST['email']);
					$from = "High School Reunion <" . $noreply . ">";
					$link = $site_root . 'hsr-admin/confirm.php?hash=' . $hash . '&email=' . $encoded_email;
					$mail_body = <<<EOMAILBODY
<html>
<body>
<p>Thank you for registering at $site_name. Click this link
to confirm your registration.</p>

<p><a href="$link">$link</a></p>

<p>Once you see a confirmation message, you will be logged into
$site_name.</p>
</body>
</html>
EOMAILBODY;

			$headers = "From: $from\r\n";
			$headers .= "Content-type: text/html\r\n";
			$headers .= "Reply-to: $from\r\n";
			$headers .= "X-Mailer: PHP/" . phpversion();

		mail("$email", "$site_name Registration Confirmation", "$mail_body", "$headers");


	// Give a successful registration message
			$feedback = 'You have Successfully Registered.
				You will receive a confirmation email soon';
			return $feedback;
			}
		}
	} else {
		$feedback = 'ERROR: Username or password is invalid';
		return $feedback;
	}
} else {
	$feedback = 'ERROR: Please fill in all fields correctly';
	return $feedback;
	}
	
} else {
	$feedback = 'ERROR: You can\'t register until you graduate';
	return $feedback;
}
}

function account_namevalid() {

	// parameter for use with strspan
	$span_str = "abcdefghijklmnopqrstuvwxyz" .
		"ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-";
		
		// must have at least one character
		if (strspn($_POST['user_name'],$span_str) == 0) {
			return false;
		}
		
		// must contain all legal characters
//		if (strspn($_POST['user_name'],$span_str) != strlen($user_name)) {
//			return false;
//		}
		
// illegal names
		if
	(eregi("^((root)|(bin)|(daemon)|(adm)|(lp)|(sync)|(shutdown)|
		(halt)|(mail)|(news)|(uucp)|(operator)|(games)|(mysql)|
		(httpd)|(nobody)|(dummy)|(www)|(cvs)|(shell)|(ftp)|(irc)|
		(debian)|(ns)|(download))$", $_POST['user_name'])) {
			return false;
		}
		if (eregi("^(anoncvs_)", $_POST['user_name'])) {
			return false;
		}
		
	return true;
	}
	
	 function validate_email () { 
		return (ereg('^[-!#$%\'*+./0-9=?A-Z^_`a-z{|}~]+'. '@'. 
		'[-!#$%\'*+\/0-9=?A-Z^_`a-z{|}~]+.' . 
		'[-!#$%\'*+\./0-9=?A-Z^_`a-z{|}~]+$', $_POST['email'])); 
} 
	
	
	function user_confirm() {	
	// This function will only work with superglobal arrays,
	// because I'm not passing in any values of declaring globals
	global $hash_padding;
	
	// Verify that they didn't tamper with the email address
	$new_hash = md5($_GET['email'].$hash_padding);
	if ($new_hash && ($new_hash == $_GET['hash'])) {
		$query = "SELECT user_name
				FROM users
				WHERE confirm_hash = '$new_hash'";
		$result = mysql_query($query);
		if (!$result || mysql_num_rows($result) < 1) {
		$feedback = 'ERROR: Confirmation code not found';
		return $feedback;
	} else {
		// Confirm the email and set account to active
		$email = $_GET['email'];
		$hash = $_GET['hash'];
	$query = "UPDATE users
			SET email='$email', is_confirmed='1'
			WHERE confirm_hash='$hash'";
				$result = mysql_query($query);
				return 1;
			}
		} else {		
		$feedback = 'ERROR: Confirmation values do not match';
		return $feedback;		
		}
	}
?>