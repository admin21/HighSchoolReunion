<?php

include_once('../hsr-config.php');

// A string used for md5 encryption. You could move it to
// a file outside the web tree fro more security

$LOGGED_IN = false;
unset($LOGGED_IN);

function user_isloggedin() {
	// This function will only work with superglobal arrays,
	// because I'm not passing in any values or declaring globals
	global $hash_padding, $LOGGED_IN;
	
	// Have we already run the hash checks?
	// If so, return the pre-set var
	if (isSet($LOGGED_IN)) {
		return $LOGGED_IN;
	}
	if ($_COOKIE['user_name'] && $_COOKIE['id_hash']) {
		$hash = md5($_COOKIE['user_name']
				.$hash_padding);
		if ($hash == $_COOKIE['id_hash']) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function user_login() {
	// This function will only work with superglobal arrays,
	// because I'm not passnig in any values or declaring globals
	global $hash_padding;
	

if (!$_POST['user_name'] || !$_POST['password']) {
	$feedback = 'ERROR: Missing username or password';
	return $feedback;
} else {
	$user_name = strtolower($_POST['user_name']);
	// Don't need to trim because extra spaces should fail
	// for this. Don't need to addslahses because single 
	// quotes aren't allowed.
	$password = $_POST['password'];
	// Don't need to addlashes because we'll be hashing it
	$crypt_pwd = md5($password.$hash_padding);
	$query = "SELECT user_name, is_confirmed
			FROM users
			WHERE user_name = '$user_name'
			AND password = '$crypt_pwd'";
	$result = mysql_query($query);
	
		if (user_ison($_POST['user_name'])) {
		
			if (!$result || mysql_num_rows($result) < 1){
				$feedback = 'ERROR: User not found or password incorrect';
				return $feedback;
			} else {
				if (mysql_result($result, 0, 'is_confirmed') == '1') {
					user_set_tokens($user_name);
					return 1;
				} else {
					$feedback = 'ERROR: You may not have confirmed ' .
						'your account yet';
					return $feedback;
				}
			}
		} else {
		$feedback = 'ERROR: You are not allowed to login. Your account ' .
			'is currently disabled';
		return $feedback;
		}
	}
	
}

function user_logout() {
	setcookie('user_name', '', (time()+2592000), '/', '', 0);
	setcookie('id_hash', '', (time()+2592000), '/', '', 0);
}

function user_set_tokens($user_name_in) {
	global $hash_padding;
	if (!$user_name_in) {
		$feedback = 'ERROR: No username';
		return false;
	}
	$user_name = strtolower($user_name_in);
	$id_hash = md5($user_name.$hash_padding);
	
	setcookie('user_name', $user_name, (time()+2592000), '/', '', 0);
	setcookie('id_hash', $id_hash, (time()+2592000), '/', '', 0);
}

?>