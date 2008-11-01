<?php include('header.php'); ?>

	<div id="content">
		<h1><?php the_title(); ?></h1>
		<div id="date"><?php the_date(); ?></div>
		
		<div class="entry">
			<?php the_entry(); ?>
		</div>
	</div>

<?php include('footer.php'); ?>