<?php

include('header_footer.php');
include('../hsr-config.php');

if (user_can(1)) {

site_head('HSR Options');

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'form';
}

switch($page) {
	case 'post':

$title = $_POST['title'];
$tagline = $_POST['tagline'];
$root = format_root($_POST['root']);
$noreply = $_POST['noreply'];
$priv = $_POST['priv_policy'];

// Update title
$query7 = "UPDATE options
	SET option_value = '$title'
	WHERE option_name = 'alumni_title'";
$result7 = mysql_query($query7);

// Update tagline
$query8 = "UPDATE options
	SET option_value = '$tagline'
	WHERE option_name = 'tagline'";
$result8 = mysql_query($query8);

// Update root
$query9 = "UPDATE options
	SET option_value = '$root'
	WHERE option_name = 'site_root'";
$result9 = mysql_query($query9);

// Update title
$query10 = "UPDATE options
	SET option_value = '$noreply'
	WHERE option_name = 'noreply'";
$result10 = mysql_query($query10);

// Update title
$query11 = "UPDATE options
	SET option_value = '$priv'
	WHERE option_name = 'priv_policy'";
$result11 = mysql_query($query11);

header("Location: options.php");

	break;
	case 'form':

// Get title
$query2 = "SELECT * FROM options WHERE option_name = 'alumni_title'";
$result2 = mysql_query($query2);
while ($row = mysql_fetch_array($result2)) {
	$title = $row['option_value'];
	}
	
// Get tagline
$query3 = "SELECT * FROM options WHERE option_name = 'tagline'";
$result3 = mysql_query($query3);
while ($row = mysql_fetch_array($result3)) {
	$tagline = $row['option_value'];
	}
	
// Get root
$query4 = "SELECT * FROM options WHERE option_name = 'site_root'";
$result4 = mysql_query($query4);
while ($row = mysql_fetch_array($result4)) {
	$root = $row['option_value'];
	}
	
// Get noreply email
$query5 = "SELECT * FROM options WHERE option_name = 'noreply'";
$result5 = mysql_query($query5);
while ($row = mysql_fetch_array($result5)) {
	$noreply = $row['option_value'];
	}
	
// Get noreply email
$query6 = "SELECT * FROM options WHERE option_name = 'priv_policy'";
$result6 = mysql_query($query6);
while ($row = mysql_fetch_array($result6)) {
	$priv = $row['option_value'];
	}

?>
<?php optionnav(); ?>
<div id="holder">
<form action="options.php?page=post" method="post">
<p>Site Title<br /><input class="input" name="title" type="text" value="<?php echo $title; ?>" size="50" /></p>
<p>Tagline<br /><input class="input" name="tagline" type="text" value="<?php echo $tagline; ?>" size="50" /></p>
<p>Site Root<br /><input class="input" name="root" type="text" value="<?php echo $root; ?>" size="50" /></p>
<p>No Reply Email<br /><input class="input" name="noreply" type="text" value="<?php echo $noreply; ?>" size="50" /></p>
<p>Privacy Policy<br /><textarea class="content" name="priv_policy" cols="96" rows="15"><?php echo $priv; ?></textarea></p>
<p align="right"><input name="submit" type="submit" value="Save" /></p>
</form>
</div>
	<?php break;
	
}

site_footer();

} else {

header("Location: edit-userinfo.php");

}

?>