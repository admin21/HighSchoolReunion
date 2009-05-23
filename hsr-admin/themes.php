<?php

require_once('../hsr-config.php');
include('header_footer.php');

if (user_can(1)) {

	$title = sitename() . ' Admin';

	site_head($title);
	
	$username = $_COOKIE['user_name'];
	
?>
<?php designnav(); ?>
<div id="holder">
<h2>Themes</h2>
<h3>Current Theme</h3>
<div class="theme">
<div class="title"><?php echo current_theme(); ?></div>
<div class="screenshot"><img src="../hsr-content/themes/<?php echo current_theme(); ?>/screenshot.jpg" alt="<?php echo current_theme(); ?> Screenshot" /></div>
</div>
<div style="clear:both"></div>
<h3>Available Themes</h3>
<?php
$dir = "../hsr-content/themes";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
$info = array_slice($files, 2);
foreach($info as $file) {
?>
<?php //check for broken themes ?>
<?php if(valid_theme($file)): ?>
<div class="theme">
<div class="title"><?php echo $file; ?></div>
<div class="screenshot"><a href="activate.php?t=<?php echo $file; ?>"><img src="../hsr-content/themes/<?php echo $file; ?>/screenshot.jpg" alt="<?php echo $file ?> Screenshot" /></a></div>
</div>
<?php endif; ?>
<?php	} ?>
</div>
<?php site_footer(); ?>
<?php 
} else {
echo "You're not allowed to do that!";
} 
?>