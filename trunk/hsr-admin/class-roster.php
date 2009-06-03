<?php

require('../hsr-config.php');
include('header_footer.php');
include('../hsr-includes/login_funcs.php');

if (!user_isloggedin()) {
	header("Location: login.php");
}

$grad_year = $_GET['grad_year'];

$header = sitename() . ' &raquo; ' . $grad_year;

site_head($header);
?>

<div id="holder">
<h1>Class of <?php echo $grad_year; ?></h1>
<?php class_roster($grad_year); ?>
</div>

<?php site_footer(); ?>