<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(3)) {

$class = get_theclass();	
$header = 'Email the class of ' . $class;

site_head($header);

?>
<?php dashnav(); ?>
<div class="big-form">
<h1><?php echo $header; ?></h1>

<form action="post.php" method="post">

<p>Subject<br /><input class="input" name="subject" type="text"></p>
<p>Message<br /><textarea class="content" name="message" cols="96" rows="15"></textarea></p>
<input type="hidden" name="type" value="class_email">
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