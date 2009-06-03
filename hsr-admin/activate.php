<?php
require_once('../hsr-config.php');
if(user_can(2)) {

	if(isset($_GET['t'])) {
		$theme = $_GET['t'];
		$query = "UPDATE options SET option_value = '$theme' WHERE option_name = 'theme'";
		$result = mysql_query($query);
		header("Location: themes.php");
	} elseif(isset($_GET['s'])) {
		if($_GET['s'] == 'other') {
			$dark = $_POST['dark'];
			$light = $_POST['light'];
		} else {		
			$colors = explode('-', $_GET['s']);
			$dark = $colors[0];
			$light = $colors[1];
			
				switch($dark) {
					case 'red':
						$dark = '#CC0000';
					break;
					case 'blue':
						$dark = '#0000FF';
					break;
					case 'green':
						$dark = '#006600';
					break;
					case 'maroon':
						$dark = '#990000';
					break;
					case 'white':
						$dark = '#FFFFFF';
					break;
					}
					
				switch($light) {
					case 'red':
						$light = '#FF0000';
					break;
					case 'white':
						$light = '#FFFFFF';
					break;
					case 'yellow':
						$light = '#FFFF00';
					break;
					case 'black':
						$light = '#000000';
					break;
					}
				}
										
		$query = "UPDATE options SET option_value = '$dark' WHERE option_name = 'dark_color'";
		$result = mysql_query($query);
		$query = "UPDATE options SET option_value = '$light' WHERE option_name = 'light_color'";
		$result = mysql_query($query);
		header("Location: custom-styles.php");
	} elseif(isset($_GET['l'])) {
		$logo = $_GET['l'];
		$query = "UPDATE options SET option_value = '$logo' WHERE option_name = 'logo'";
		$result = mysql_query($query);
		header("Location: logo.php");
	} else {
		echo 'Sorry, there was an error. Please try that again.';
	}
} else {
	echo "You can't do that!";
}

?>