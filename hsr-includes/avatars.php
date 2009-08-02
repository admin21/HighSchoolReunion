<?php

	function get_avatar($username = '', $size = '80', $rating = 'g', $default = 'i') {
	
		if($username == '') {
			$email = get_userinfo('email');
		} else {
			$email = get_userinfo('email', $username);
		}
		
		$baseurl = "http://www.gravatar.com/avatar/";
		
		$hash = md5(strtolower($email));
		
		$s = 's='.$size;
		
		$r = '&r='.$rating;
		
		$d = array(
			'n'	=>	'none',
			'i'	=>	'identicon',
			'm'	=>	'monsterid',
			'w'	=>	'wavatar'
		);
		
		$default = '&d='.$d[$default];
		
		return $baseurl . $hash . '?' . $s . $r . $default;
		
	}

?>