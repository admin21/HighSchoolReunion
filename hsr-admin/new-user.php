<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(1)) {

site_head('New User');
	
?>
<?php usernav(); ?>
<div id="holder">
<form action="post.php" method="post">
	<p class="bold">First Name<br />
	<input type="text" name="firstname" size="20" maxlength="25"></p>
	<p class="bold">Last Name<br />
		<input type="text" name="lastname" size="20" maxlength="25"></p>
	<p class="bold">Username<br />
		<input type="text" name="username" size="10" maxlength="25"></p>
	<p class="bold">Graduation Year<br />
      <input name="grad_year" type="text" size="10" maxlength="4"/></p>
	<p class="bold">Password<br />
		<input type="password" name="password1" size="10" maxlength="25"></p>
	<p class="bold">Password<br />
		<input type="password" name="password2"	size="10" maxlength="25"></p>
	<p class="left">Email<br />
		<input type="text" name="email" size="30" maxlength="50"></p>
	<input name="type" type="hidden" value="user" />
	<p><input type="submit" name="submit" value="Save">
	</p>
	</form>
</div>
	
<?php site_footer(); 

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}

?>