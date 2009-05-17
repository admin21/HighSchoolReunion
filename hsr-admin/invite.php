<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(3)) {

$header = 'Send an Invite';

site_head($header);

?>
<div>
<h1><?php echo $header; ?></h1>

<form action="post.php?type=invite" method="post">

<p><input name="email" type="text"> Email</p>
<p>Message<br />
<textarea class="content" name="message" cols="96" rows="15">
<?php echo get_userfirstlastname(); ?> wants to invite you to register for 
the alumni website <?php echo sitename(); ?>.
</textarea></p>
<p align="right"><input name="send" type="submit" value="Send"></p>

</form>
</div>

<?php site_footer(); 

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}

?>