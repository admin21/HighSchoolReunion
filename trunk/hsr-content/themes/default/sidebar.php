<div id="sidebar">
<div id="login">
<h2>Login</h2>


<form action="<?php echo $site_root; ?>hsr-admin/login.php" method="post">
<p class="bold">Username<br />
<input type="text" name="user_name" value="" size="15"
	maxlength="15"></p>
<p class="bold">Password<br />
<input type="password" name="password" value="" size="15"
	maxlength="15">
<br />
<span class="small"><a href="<?php echo $site_root; ?>hsr-admin/forgot.php">Forgot your password?</a><br />
<a href="<?php echo $site_root; ?>hsr-admin/register.php">New Member?</a></span>
</p>
<p><input type="submit" name="submit" value="Login"></p>
</form>

</div>
<div id="new-members">
<h2>New Members</h2>
<?php all_new_members(); ?>
</div>
<!--<div id="links">
<h2>Links</h2>
<?php /*show_links('<ul>', '<li>', '</li>', '</ul>');*/ ?>
</div>-->
</div>
