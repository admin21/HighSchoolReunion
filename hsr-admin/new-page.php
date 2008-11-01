<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(2)) {

site_head('New Page');

?>
<?php postnav(); ?>
<div id="holder" class="big-form">
<form action="post.php" method="post">
<p>Title<br /><input class="input" name="title" type="text"></p>
<textarea class="content" name="content" rows="15"></textarea>
<p align="right">
<input name="type" type="hidden" value="page" />
<input name="submit" type="submit" value="Save"></p>
</form>
</div>

<?php
site_footer();

} else {

site_head('Error');

echo 'You are not allowed to view this page';

site_footer();

}

?>