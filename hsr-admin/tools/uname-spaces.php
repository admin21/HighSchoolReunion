<?php

/***************************************
Take Out the Spaces (c) 2009. Josh Betz.

Used to fix spaced unames - pre 0.9

If conflicts occur, check which are
confirmed, (1) if 1 is confirmed, delete
the unconfirmed, (2) if multiple are
confirmed, email user to change
****************************************/

require('../hsr-config.php');

$query = 'SELECT * FROM users';
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
	if(no_spaces($row['user_name'])) {
		fix_spaced_uname($row['user_id']);
	}
}

function fix_spaced_uname() {

}
?>