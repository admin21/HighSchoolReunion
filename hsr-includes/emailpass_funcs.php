<?php

include_once('../hsr-config.php');

function user_change_password() {
	global $hash_padding;
	
	// Do new passwords match?
	if ($_POST['new_password1'] && ($_POST['new_password1'] ==
		$_POST['new_password2'])) {
		// Is password long enough?
		if (strlen($_POST['new_password1']) >= 6) {
			// Is the old password correct?
			if (strlen($_POST['old_password']) > 1) {
				$change_user_name = $_COOKIE['user_name'];
				$old_password = $_POST['old_password'];
					$crypt_pass = md5($old_password.$hash_padding);
					$new_password1 = $_POST['new_password1'];
					$query = "SELECT *
							FROM users
							WHERE user_name = '$change_user_name'
							AND password = '$crypt_pass'";
					$result = mysql_query($query);
					if (!$result || mysql_num_rows($result) < 1) {
						$feedback = 'ERROR: User not found or bad password';
						return $feedback;
					} else {
						$crypt_newpass = md5($new_password1.$hash_padding);
					$query = "UPDATE users
							SET password = '$crypt_newpass'
							WHERE user_name = '$change_user_name'
							AND password = '$crypt_pass'";
					$result = mysql_query($query);
					if (!$result || mysql_affected_rows() < 1) {
						$feedback = 'ERROR: Problem updating password';
						return $feedback;
					} else {
						return 1;
					}
				}
			} else {
				$feedback = 'ERROR: Please enter old password';
				return $feedback;
			}
		} else {
			$feedback = 'ERROR: New password is not long enough';
			return $feedback;
		}
	} else {
		$feedback = 'ERROR: Your passwords do not match';
		return $feedback;
	}
}

function user_change_email() {
	global $hash_padding, $site_root, $site_name, $noreply;
	if (validate_email($_POST['new_email'])) {
		$hash = md5($_POST['new_email'].$hash_padding);
		
		// Send out a new confirm email with a new hash
		$user_name = strtolower($_COOKIE['user_name']);
		$password1 = strtolower($_POST['password1']);
		$email = $_POST['new_email'];
		$crypt_pass = md5($password1.$hash_padding);
		$query = "UPDATE users
				SET confirm_hash = '$hash',
					is_confirmed = 0
				WHERE user_name = '$user_name'
				AND password = '$crypt_pass'";
		$result = mysql_query($query);
		if (!$result || mysql_affected_rows() < 1) {
			$feedback = 'ERROR: Wrong password';
			return $feedback;
		} else {
			// Send the confirmation email
			$encoded_email = urlencode($_POST['email']);
			$from = $noreply;
			$link = $site_root . 'hsr-admin/confirm.php?hash=' . $hash . '&email=' . $encoded_email;
			$mail_body = <<<EOMAILBODY
<html>
<body>
<p>Thank you for registering at $site_name. Click this link to
confirm your registration:</p>

<p><a href="$link">$link</a></p>

<p>Once you see a confirmation message, you will be logged
into $site_name.</p>
</body>
</html>
EOMAILBODY;

			$headers = "From: $from\r\n";
			$headers .= "Content-type: text/html\r\n";
			$headers .= "Reply-to: $from\r\n";
			$headers .= "X-Mailer: PHP/" . phpversion();

		mail("$email", "New Email Confirmation", "$mail_body", "$headers");
		// If you use email rather than password cookies, uncomment the following line
		// user_set_tokens($user_name);
		return 1;
	}
} else {
	$feedback = 'ERROR: New email address is invalid';
	return $feedback;
	}
}

?>