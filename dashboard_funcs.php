<?php

function dash_sub($menu) {
	
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$menus 				=		array
(

	"Dashboard"		=>		array
	(
		0				=>		siteroot() . "hsr-admin/index.php"
	),
	"Posts"			=>		array
	(
		0				=>		siteroot() . "hsr-admin/new-page.php",
		1				=>		siteroot() . "hsr-admin/new-event.php",
		2				=>		siteroot() . "hsr-admin/manage-posts.php"
	),
	"Links"			=>		array
	(
		0				=>		siteroot() . "hsr-admin/new-link.php",
		1				=>		siteroot() . "hsr-admin/manage-links.php"
	),
	"Themes"		=>		array
	(
		0				=>		siteroot() . "hsr-admin/themes.php",
		1				=>		siteroot() . "hsr-admin/themes.php"
	),
	"Users"			=>		array
	(
		0				=>		siteroot() . "hsr-admin/new-user.php",
		1				=>		siteroot() . "hsr-admin/manage-users.php"
	),
	"Options"		=>		array
	(
		0				=>		siteroot() . "hsr-admin/options.php",
		1				=>		siteroot() . "hsr-admin/options.php"
	)
);

}

?>