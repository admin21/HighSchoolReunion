<?php

	get_avatar($username = '', $size = '80', $rating = 'g', $default = 'i') {
	
		if($username == '') {
			$email = get_userinfo('email');
		} else {
			$email = // Fill it in with a new function
		}
		
		$baseurl = "http://www.gravatar.com/avatar/";
		
		$hash = md5($email);
		
		$s = 's='.$size;
		
		$r = 'r='.$rating;
		
		$d = array(
			'n'	=>	'none',
			'i'	=>	'identicon',
			'm'	=>	'monsterid',
			'w'	=>	'wavatar'
		);
		
		return $baseurl . $hash . '?' . $s . '&' . $r . '&' . $d;
		
	}

?>