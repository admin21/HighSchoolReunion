<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(2)) {

site_head('Edit Post');

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id = '$id' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
		$title = $row['post_title'];
		$content = $row['post_content'];
		$type = $row['post_type'];
		$date = $row['due_date'];
		$class = $row['event_class'];
		$status = $row['post_status'];
	}
	
	$month = date('F', $date);
	$day = date('d', $date);
	$year = date('Y', $date);
	$hour = date('g', $date);
	$min = date('i', $date);
	$ampm = date('a', $date);

?>

<div id="holder" class="big-form">
<form action="post.php" method="post">
<div class="left-col">
<p>Title<br /><input class="input" name="title" type="text" value="<?php echo $title; ?>"></p>
<textarea class="content" name="content" rows="15"><?php echo $content; ?></textarea>
</div>
<div class="left-col">
<?php if ($type == "event") { ?>
<div class="small-form">
<p>Class<br /><input name="class" type="text" value="<?php echo $class; ?>" /></p>
<p>Status <br /><?php list_poststatus($id); ?></p>
<p>
Date:<br />
<input name="month" type="text" value="<?php echo $month; ?>" size="8" />
<input name="day" type="text" value="<?php echo $day; ?>" size="2" />, 
<input name="yr" type="text" value="<?php echo $year; ?>" size="4" />
</p>
<p>
Time:<br />
<input name="hr" type="text" value="<?php echo $hour; ?>" size="2" /> : 
<input name="min" type="text" value="<?php echo $min; ?>" size="2" />
<input name="ampm" type="text" value="<?php echo $ampm; ?>" size="3" />
</p>
</div>
<?php } else { ?>
<input name="class" type="hidden" value="<?php echo $class; ?>" />
<input name="month" type="hidden" value="<?php echo $month; ?>" size="10" />
<input name="day" type="hidden" value="<?php echo $day; ?>" size="2" />
<input name="yr" type="hidden" value="<?php echo $year; ?>" size="4" />
<input name="hr" type="hidden" value="<?php echo $hour; ?>" size="2" />
<input name="min" type="hidden" value="<?php echo $min; ?>" size="2" />
<input name="ampm" type="hidden" value="<?php echo $ampm; ?>" size="2" />

<?php } ?>
</div>
<br class="clear">
<input name="post_type" type="hidden" value="<?php echo $type; ?>" />
<input name="type" type="hidden" value="edit" />
<input name="id" type="hidden" value="<?php echo $id; ?>" />
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