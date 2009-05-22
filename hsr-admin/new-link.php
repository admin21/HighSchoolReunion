<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(2)) {

site_head('New Link');

?>
<?php linknav(); ?>
<div id="holder" class="big-form">
<form action="post.php" method="post">
<p>Title<br /><input class="input" name="title" type="text"></p>
<p>URL<br /><input class="input" name="url" type="text" value="http://" /></p>
<p>Description<br /><textarea class="content" name="description" rows="5"></textarea></p>
<p align="right">
<input name="type" type="hidden" value="link" />
<input name="submit" type="submit" value="Save">
</p>
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