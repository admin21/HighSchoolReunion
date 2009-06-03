<?php
include('header.php');
include('sidebar.php');
?>

<div id="content">
<div id="welcome">
<?php welcome_message(); ?>
</div>
<div id="upcoming-events">
<h2>Upcoming Events</h2>
<?php upcoming_events();?>
</div>
<div class="clear"></div>
</div>

<?php
include('footer.php');
?>