<?php
include("../hsr-config.php");

//Convert rank from 4 to 3
$query = "UPDATE users SET rank =3 WHERE rank =4";
$result = mysql_query($query);

//Update rank to accept 1,2,3 and not 4
$query = "ALTER TABLE `users` CHANGE `rank` `rank` ENUM( '1', '2', '3' ) NOT NULL DEFAULT '3'";
$result = mysql_query($query);

//Add Admin Post review
$query = "ALTER TABLE `posts` ADD `post_status` ENUM( 'draft', 'review', 'publish' ) NOT NULL AFTER `post_date`";
$result = mysql_query($query);

//Add theme selection
$query = "INSERT INTO options (option_name, option_value, option_description, option_date)
			VALUES ('theme', 'default', 'The website theme', NOW())";
$result = mysql_query($query);

//Add custom colors to stylesheet
$query = "INSERT INTO options (option_name, option_value, option_description) 
			VALUES ('dark_color', '#CC0000', 'The hex value of the dark color for the admin color scheme'), 
			('light_color', '$FF0000', 'The hex value of the light color for the admin color scheme')";
$result = mysql_query($query);

//Add logos
$query = "INSERT INTO options (option_name, option_value, option_description)
			VALUES ('logo', 'none', 'The name of the img file for the logo')";
$result = mysql_query($query);

?>