<?php
include('header.php');

$post = $_GET['p'];

$query = "SELECT post_title, post_slug, post_content, post_type, due_date FROM posts WHERE id = '$post' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		$title = $row['post_title'];
		$content = hsrautop($row['post_content']);
		$due_date = $row['due_date'];
		$type = $row['post_type'];
			
		}

function the_title() {
global $title;
	echo $title;
	}
	
function the_entry() {
global $content;
	echo $content;
	}
	
function the_date() {
global $due_date;
	if ($type == 'event') {
		echo date('m/d/y \@ g:i a', $due_date);
	} else {
		echo '';
	}
}


?>

	<div id="content">
		<h1><?php the_title(); ?></h1>
		<div id="date"><?php the_date(); ?></div>
		
		<div class="entry">
			<?php the_entry(); ?>
		</div>
	</div>

<?php
include('footer.php');
?>