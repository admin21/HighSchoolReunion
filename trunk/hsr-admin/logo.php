<?php

require_once('../hsr-includes/login_funcs.php');
include('header_footer.php');

if (user_can(1)) {

	$title = $site_name . ' Admin';

	site_head($title);
	
	$username = $_COOKIE['user_name'];
	
?>
<?php designnav(); ?>
<div id="holder">
<script src="../hsr-includes/js/list-edit.js" type="text/javascript"></script>
<h2>Logos</h2>
<h3>Current Logo</h3>
<div class="logo"><?php echo get_currentlogo(); ?></div>
<div style="clear:both"></div>
<h3>Uploaded Logos</h3>
<div class="logos">
<div class="title">None</div>
<div class="nologo"><a href="activate.php?l=none">None</a></div>
</div>
<?php
$dir = "../hsr-content/uploads/logos";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
$info = array_slice($files, 2);
foreach($info as $file) {
if (substr($file, -4) == '.jpg' || substr($file, -4) == '.bmp' || substr($file, -4) == '.png' || substr($file, -4) == '.gif' || substr($file, -5) == '.jpeg'):
?>

<div class="logos">
<div class="title"><?php echo $file; ?> <a href="javascript:confirmdelete( 'logo', '<?php echo $site_root ?>', '<?php echo $file ?>', '<?php echo $file ?>' )"><img src="img/delete.jpg" /></a></div>
<div class="logo"><a href="activate.php?l=<?php echo $file; ?>"><img src="../hsr-content/uploads/logos/<?php echo $file; ?>" alt="<?php echo $file ?>" /></a></div>
</div>
<?php endif; ?>
<?php	} ?>
<div style="clear:both"></div>
<h3>Add a Logo</h3>
<p>Note: Only <strong>.jpg</strong>, <strong>.bmp</strong>, <strong>.png</strong>, and <strong>.gif</strong> files are allowed.<br />
We recommend that the file is a maximum of 70 pixels tall.</p>
<form action="post.php?type=uploader" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<br />
<input type="submit" value="Upload File" />
</form>
</div>
<?php site_footer(); ?>
<?php 
} else {
echo "You're not allowed to do that!";
} 
?>