<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(2)) {


site_head('Edit Link');

$id = $_GET['id'];

$query = "SELECT * FROM links WHERE id = '$id' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
		$title = $row['name'];
		$url = $row['URL'];
		$description = $row['description'];
	}
	
?>

<div id="holder" class="big-form">
<form action="post.php" method="post">
<p>Title<br /><input class="input" name="title" type="text" value="<?php echo $title; ?>" /></p>
<p>URL<br /><input class="input" name="url" type="text" value="<?php echo $url; ?>" /></p>
<p>Description<br /><textarea class="content" name="description" rows="5"><?php echo $description; ?></textarea></p>
<p align="right">
<input name="type" type="hidden" value="link-edit" />
<input name="id" type="hidden" value="<?php echo $id; ?>"  />
<input name="submit" type="submit" value="Save">
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