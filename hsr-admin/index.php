<?php

include('../hsr-config.php');
include('header_footer.php');

if (user_can(3)) {

ob_start();

	$title = sitename() . ' Admin';
	
	$username = $_COOKIE['user_name'];

	site_head($title);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 'home';
	}	

?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_jumpMenuGo(selName,targ,restore){ //v3.0
  var selObj = MM_findObj(selName); if (selObj) MM_jumpMenu(targ,selObj,restore);
}
//-->
</script>
<div id="holder">
<?php dashnav(); ?>
<?php

switch($page) {
	case 'message': 

if (user_can(1)) {

	$query = "SELECT option_value FROM options WHERE option_name = 'admin_message'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$admin_message = $row['option_value'];
	}
	
	$timestamp = time();
	$time = date('m/d/Y \@ g:i a', $timestamp);

?>
	<h1>Admin Message</h1>
	<div class="big-form">
	<form action="index.php?page=post" method="post">
	<input class="input" name="time" type="text" disabled="disabled" value="<?php echo $time; ?>">
  <p><textarea class="content" name="content" rows="15"><?php echo $admin_message; ?></textarea></p>
  <input name="name" type="hidden" value="admin_message"  />
  <input class="input" name="title" type="hidden" value="Admin Message"  />
  <input name="timestamp" type="hidden" value="<?php echo $timestamp; ?>" /><br />
  <input name="submit" type="submit" value="Save" /><br />
  

</form>
</div>
<?php

} else {
	header("Location: index.php");
}

	break;

	case 'welcome':
	
	if (user_can(1)) {
	
	$query = "SELECT * FROM options WHERE option_name = 'welcome_message'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$welcome_message = $row['option_value'];
		$welcome_title = $row['option_description'];
	}
	
	$timestamp = time();

?>
	<h1>Welcome Message</h1>
	<div class="big-form">
	<form action="index.php?page=post" method="post">
	
	<input class="input" name="title" type="text" size="35" value="<?php echo $welcome_title; ?>">
  <p><textarea class="content" name="content" rows="15"><?php echo $welcome_message; ?></textarea></p>
  <input name="name" type="hidden" value="welcome_message"  />
  <input name="timestamp" type="hidden" value="<?php echo $timestamp; ?>" />
  <br />
  <input name="submit" type="submit" value="Save" />
  

</form>
</div>
<?php

} else {
	header("Location: index.php");
}

	break;
	
	case 'post':

	$title = $_POST['title'];
	$message = $_POST['content'];
	$name = $_POST['name'];
	$timestamp = $_POST['timestamp'];

	$query = "UPDATE options SET option_value = '$message', option_description = '$title', option_date = '$timestamp' WHERE option_name = '$name'";
	$result = mysql_query($query);
	header("Location: index.php");


	break;

	case 'home':
	default: ?>
<div id="left" class="column">
<div id="gen-info" class="box">
<img style="float: right;" src="<?php echo get_avatar($username); ?>" alt="" />
<h4>General Info</h4>
<?php general_info($username); ?>
</div>
<div id="contact-info" class="box">
<h4>Contact Info</h4>
<?php contact_info($username); ?>
</div>
<?php if(is_userevents($username)): ?>
<div id="upcoming-events" class="box">
<h4>Your Upcoming Events</h4>
<?php user_upcoming_events($username);?>
</div>
<?php endif; ?>
</div>
<div id="right" class="column">
<?php if(is_adminmessage()): ?>
<div id="admin-message" class="box">
<h4>Message from the Admin</h4>
<?php admin_message(); ?>
</div>
<?php endif; ?>
<?php if(is_userlinks($username)): ?>
<div id="websites" class="box">
<h4>Websites</h4>
<?php user_links($username); ?>
</div>
<?php endif; ?>
<div id="lastten" class="box">
<?php user_lastten($username); ?>
</div>
<div id="classlist" class="box">
<h4>Class List</h4>
<form>
  <p>
<?php grad_list_links(); ?>
</p>
</form>
</div>
</div>
<?php
	break;
	} ?>
</div>
<?php site_footer(); ?>
<?php
} else {
echo "You're not allowed to do that!";
} 
?>