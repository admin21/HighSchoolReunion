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
<h2>Custom Styles</h2>
<h3>Current Style</h3>
<div class="theme"><?php echo displaystylethumb(); ?></div>
<div style="clear:both"></div>
<h3>Available Styles</h3>
<div class="theme"><a href="activate.php?s=red-red"><img src="img/style-swatches/red-red.png" alt="Red-Red" /></a></div>
<div class="theme"><a href="activate.php?s=blue-white"><img src="img/style-swatches/blue-white.png" alt="Blue-White" /></a></div>
<div class="theme"><a href="activate.php?s=blue-yellow"><img src="img/style-swatches/blue-yellow.png" alt="Blue-Yellow" /></a></div>
<div class="theme"><a href="activate.php?s=green-white"><img src="img/style-swatches/green-white.png" alt="Green-White" /></a></div>
<div class="theme"><a href="activate.php?s=green-yellow"><img src="img/style-swatches/green-yellow.png" alt="Green-Yellow" /></a></div>
<div class="theme"><a href="activate.php?s=maroon-red"><img src="img/style-swatches/maroon-red.png" alt="Maroon-Red" /></a></div>
<div class="theme"><a href="activate.php?s=maroon-white"><img src="img/style-swatches/maroon-white.png" alt="Maroon-White" /></a></div>
<div class="theme"><a href="activate.php?s=red-white"><img src="img/style-swatches/red-white.png" alt="Red-White" /></a></div>
<div class="theme"><a href="activate.php?s=white-black"><img src="img/style-swatches/white-black.png" alt="White-Black" /></a></div>
<div style="clear:both"></div>
<h3>Custom Styles</h3>
<p>Here you can enter the hex values or RGB values of the primary and secondary colors that you would like to use.<br />
<strong>Example Hex: </strong> Primary: <u><em>#CC0000</em></u> Secondary: <u><em>#FF0000</em></u> | Need the <a href="http://www.cookwood.com/html/colors/websafecolors.html" target="_blank">Web Safe Colors</a>?<br />
</p>
<form action="activate.php?s=other" method="post">
<p><input name="dark" type="text" value="<?php echo get_stylecolors('primary'); ?>" /> Primary Color</p>
<p><input name="light" type="text" value="<?php echo get_stylecolors('secondary'); ?>" /> Secondary Color</p>
<p><input name="save" type="submit" value="Save" /></p>
</form>
</div>
<?php site_footer(); ?>
<?php 
} else {
echo "You're not allowed to do that!";
} 
?>