<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(3)) {

site_head('New Event');

?>
<?php postnav(); ?>
<div id="holder" class="big-form">
<form action="post.php" method="post">
<div class="left-col">
<p>Title<br /><input class="input" name="title" type="text"></p>
<textarea class="content" name="content" rows="15"></textarea>
</div>
<div class="left-col">
<div class="small-form">
<p>
Date:<br />
<input name="month" type="text" value="<?php echo date('F', time()); ?>" size="8" />
<input name="day" type="text" value="<?php echo date('d', time()); ?>" size="2" />, 
<input name="yr" type="text" value="<?php echo date('Y', time()); ?>" size="4" />
</p>
<p>
Time:<br />
<input name="hr" type="text" value="<?php echo date('h', time()); ?>" size="2" /> : 
<input name="min" type="text" value="<?php echo date('i', time()); ?>" size="2" />
<input name="ampm" type="text" value="<?php echo date('a', time()); ?>" size="3" />
</p>
</div>
</div>
<br class="clear" />
<p><input name="email" type="checkbox" value="checked" checked /> Email event notification to your class?</p>
<input name="class" type="hidden" value="<?php echo get_theclass(); ?>" />
<input name="type" type="hidden" value="event" />
<input name="submit" type="submit" value="Save" />
</form>
</div>
<?php site_footer(); 

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}

?>