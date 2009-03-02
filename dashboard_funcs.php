<?php

function dash_sub($menu) {
global $site_root;
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$menus 				=		array
(

	"Dashboard"		=>		array
	(
		0				=>		$site_root . "hsr-admin/index.php"
	),
	"Posts"			=>		array
	(
		0				=>		$site_root . "hsr-admin/new-page.php",
		1				=>		$site_root . "hsr-admin/new-event.php",
		2				=>		$site_root . "hsr-admin/manage-posts.php"
	),
	"Links"			=>		array
	(
		0				=>		$site_root . "hsr-admin/new-link.php",
		1				=>		$site_root . "hsr-admin/manage-links.php"
	),
	"Themes"		=>		array
	(
		0				=>		$site_root . "hsr-admin/themes.php",
		1				=>		$site_root . "hsr-admin/themes.php"
	),
	"Users"			=>		array
	(
		0				=>		$site_root . "hsr-admin/new-user.php",
		1				=>		$site_root . "hsr-admin/manage-users.php"
	),
	"Options"		=>		array
	(
		0				=>		$site_root . "hsr-admin/options.php",
		1				=>		$site_root . "hsr-admin/options.php"
	)
);

}

?>