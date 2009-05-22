<?php
include("../hsr-config.php");

// Add homepage link option
// Add cur_vers for future dbase updates

$query = "INSERT INTO `hsr`.`options` (`option_name`, `option_value`, `option_description`) 
	VALUES ('homepage', 'http://', 'If there is another page you want displayed as the homepage in the links.'),
	('cur_vers', '.80', 'The current version of High School Reunion. Used for database updates')";

$result = mysql_query($query);


?>