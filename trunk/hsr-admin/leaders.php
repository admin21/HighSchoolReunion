<?php

include('header_footer.php');
include('../hsr-config.php');
include('../hsr-includes/login_funcs.php');
site_head('Leaders');

if (user_can(3)) {

function leaders() {
$leaders = array();
	$query = "SELECT * FROM users WHERE rank = '3' AND status = 'on' GROUP BY grad_year ORDER BY grad_year";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$leaders[] = $row['grad_year'];
		}
$leaders = implode(' AND grad_year != ', $leaders);
		
$leaders1 = array();
	$query1 = "SELECT * FROM users WHERE rank = '4' AND grad_year != $leaders AND status = 'on' GROUP BY grad_year ORDER BY grad_year";
	$result1 = mysql_query($query1);
	while ($row1 = mysql_fetch_array($result1)) {
		$leaders1[] = $row1['grad_year'];
		}
$leaders1 = implode(', ', $leaders1);
echo $leaders1;
		}
			
		

?>

<h1>Leaders</h1>
<small>These are the classes that have leaders, if your class isn't on here you need a leader before you can fully utilize our services.</small>
<div class="leftpad20"><p><?php leaders(); ?></p></div>


<?php
site_footer();

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}

?>