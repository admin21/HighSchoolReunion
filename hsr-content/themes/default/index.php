<?php
include('header.php');
include('sidebar.php');
?>

<div id="home-content">
<div id="welcome">
<?php welcome_message(); ?>
</div>
<div id="upcoming-events">
<h2>Upcoming Events</h2>
<?php 
if (is_events()) {
	upcoming_events();
} else {
	echo 'None';
}
?>
</div>
<div class="clear"></div>
</div>

<?php
include('footer.php');
?>