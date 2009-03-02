<?php global $first_name, $site_name, $site_root; ?>
<div id="header">
<div class="welcome">Hey <?php echo $first_name; ?>! [<a href="<?php echo $site_root; ?>" title="Go back to <?php echo $site_name; ?>">View Site</a>,  <a href="invite.php">Invite Classmates</a>,  <?php hsr_loginout(); ?>]</div>
	<div class="logo"><?php if(is_logo()) { echo get_currentlogo(); } ?></div><h1><?php echo $site_name; ?></h1>
	<div style="clear:all"></div>
<?php 

?>
<?php navbar(); ?>
</div>
<?php function navbar() { ?>
<div id="dashboard">

<script src="../hsr-includes/js/list-edit.js" type="text/javascript"></script>

    <span class="button"><a href="index.php">Dashboard</a></span>
    <span class="button"><a href="new-event.php">Posts</a></span>
	<?php if (user_can(2)) { ?>
    <span class="button"><a href="new-link.php">Links</a></span>
    <span class="button"><a href="themes.php">Design</a></span><?php } ?>
	<?php if (user_can(1)) { ?>
    <span class="button"><a href="new-user.php">Users</a></span><?php } ?> 
	<span class="button"><a href="options.php">Options</a></span>
	</div>
    
<?php } ?>
<?php function dashnav() { ?>

<div id="dash2"><span class="button"><a href="index.php">Dashboard</a></span><span class="button"><a href="email-class.php">Email Your Class</a></span>
<?php if (user_can(1)) { ?><span class="button"><a href="index.php?page=welcome">Welcome Message</a></span><span class="button"><a href="index.php?page=message">Admin Message</a></span><?php } ?></div>

<?php } ?>
<?php function postnav() { ?>

	<div id="dash2"><span class="button"><a href="new-event.php">New Event</a></span> 
	<?php if (user_can(2)) { ?><span class="button"><a href="new-page.php">New Page</a></span><span class="button"><a href="manage-posts.php">Manage Posts</a></span>
	<?php } ?>
	</div>

<?php } ?>
<?php function linknav() { ?>

<div id="dash2"><span class="button"><a href="new-link.php">New Link</a></span><span class="button"><a href="manage-links.php">Manage Links</a></span></div>

<?php } ?>
<?php function designnav() { ?>

<div id="dash2"><span class="button"><a href="themes.php">Themes</a></span><span class="button"><a href="custom-styles.php">Custom Styles</a></span><span class="button"><a href="logo.php">Logos</a></span></div>

<?php } ?>
<?php function usernav() { ?>

<div id="dash2"><span class="button"><a href="new-user.php">Add User</a></span><span class="button"><a href="manage-users.php">Manage Users</a></span></div>


<?php } ?>
<?php function optionnav() { ?>
<?php
global $site_root;
   	$username = $_COOKIE['user_name'];
	$query = "SELECT user_id FROM users WHERE user_name = '$username' LIMIT 1";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$id = $row['user_id'];
	}
?>
<div id="dash2"><?php if (user_can(1)) { ?><span class="button"><a href="options.php">HSR Options</a></span><?php } ?><span class="button"><a href="edit-userinfo.php">User Info</a></span><span class="button"><a href="changepass.php">Change Password</a></span><span class="button"><a href="changeemail.php">Change Email</a></span><span class="button"><?php echo"<a href=\"javascript:confirmdelete( 'ownuser', '" . $site_root . "', '" . $username . "', '" . $id . "' )\">Delete Account</a>"; ?></span></div>

<?php } ?>
