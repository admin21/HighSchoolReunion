<?php

	/*****************************************************
	 *	Eventually there should be no functions in this	 *
	 *	file. They should all be moved to the approriate *
	 *	file. This is just a place to keep them during   *
	 *	development.                                     *
	 *****************************************************/

function get_option($name) {
	
$result = mysql_query("SELECT * FROM options WHERE option_name='$name'");
while($row = mysql_fetch_array($result))
  {
  echo $row['option_value'];
  }
  	
}

function new_members($year) {
global $site_root;
echo '<ul>';
$query = "SELECT * FROM users WHERE grad_year = '$year' ORDER BY date_created DESC LIMIT 10";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
if(!empty($row['maiden_name'])) {
	$lname = $row['maiden_name'];
} else {
	$lname = $row['last_name'];
}
	echo '<li><a href="' . $site_root . 'hsr-admin/user.php?username=' . $row['user_name'] . '">' . $row['first_name'] . ' ' . $lname . '</a></li>';
	}
	echo '</ul>';
}

function all_new_members() {
global $site_root;

echo '<ul>';

$query = "SELECT * FROM users ORDER BY date_created DESC LIMIT 10";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	if(!empty($row['maiden_name'])) {
		$lname = $row['maiden_name'];
	} else {
		$lname = $row['last_name'];
	}
	
	echo '<li><a href="' . $site_root . 'hsr-admin/user.php?username=' . $row['user_name'] . '">' . $row['first_name'] . ' ' . $lname . '(' . $row['grad_year'] . ') </a></li>';

	}
	
echo '</ul>';

}

function general_info($username) {

$query = "SELECT user_name, first_name, maiden_name, last_name, grad_year FROM users WHERE user_name = '$username' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	echo '<p>Username: ' . $row['user_name'] . '</p>';
	echo '<p>First Name: ' . $row['first_name'] . '</p>';
	echo '<p>Maiden Name: ' . $row['maiden_name'] . '</p>';
	echo '<p>Last Name: ' . $row['last_name'] . '</p>';
	echo '<p>Class of: ' . $row['grad_year'] . '</p>';
	}
}

function contact_info($username) {

$query = "SELECT address, city, state, country, zip, home_phone, cell_phone, work_phone, work_ext, email FROM users WHERE user_name = '$username' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
		{
			echo '<p>Address: <blockquote>' . $row['address'] . '<br />';
			echo $row['city'] . ', ' . $row['state'] . '<br />';
			echo $row['country'] . ' [' . $row['zip'] . ']<br />';
			echo '</blockquote></p>';
		if (strlen($row['home_phone']) > 0)
			echo '<p>Home Phone: ' . $row['home_phone'] . '</p>';
		if (strlen($row['cell_phone']) > 0)
			echo '<p>Cell Phone: ' . $row['cell_phone'] . '</p>';
		if (strlen($row['work_phone']) > 0) 
			echo '<p>Work Phone: ' . $row['work_phone'];
		if (strlen($row['work_ext']) > 0)
			echo 'Ext: ' . $row['work_ext'] . '</p>';
			echo '<p>Email: <a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></p>';

	}
}

function is_userlinks($username) {

$query = "SELECT photo, homepage, link1, link2, link3 FROM users WHERE user_name = '$username' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$photo = $row['photo'];
	$homepage = $row['homepage'];
	$link1 = $row['link1'];
	$link2 = $row['link2'];
	$link3 = $row['link3'];
}
	if ($photo == '' && $homepage == '' && $link1 == '' && $link2 == '' && $link2 == '') {
		return false;
	} else {
		return true;
	}
	
}


function user_links($username) {

$query = "SELECT photo, homepage, link1, link2, link3 FROM users WHERE user_name = '$username' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	echo '<ul>';
	if (strlen(urldecode(stripslashes($row['photo']))) > 0) { echo '<li><a href="' . urldecode(stripslashes($row['photo'])) . '">My Photos</a></li>'; }
	if (strlen(urldecode(stripslashes($row['homepage']))) > 0) { echo '<li><a href="' . urldecode(stripslashes($row['homepage'])) . '">My Hompage</a></li>'; }
	if (strlen(urldecode(stripslashes($row['link1']))) > 0) { echo '<li><a href="' . urldecode(stripslashes($row['link1'])) . '">' . urldecode(stripslashes($row['link1'])) . '</a></li>'; }
	if (strlen(urldecode(stripslashes($row['link2']))) > 0) { echo '<li><a href="' . urldecode(stripslashes($row['link2'])) . '">' . urldecode(stripslashes($row['link2'])) . '</a></li>'; }
	if (strlen(urldecode(stripslashes($row['link3']))) > 0) { echo '<li><a href="' . urldecode(stripslashes($row['link3'])) . '">' . urldecode(stripslashes($row['link3'])) . '</a></li>'; }
	echo '</ul>';
	}
}

function user_lastten($username) {
global $site_root;

$query = "SELECT grad_year FROM users WHERE user_name = '$username' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	$year = $row['grad_year'];
	echo '<h4>New Members from: ' . $year . '</h4>';
	new_members($year);
	}
}

function hsr_loginout() {
global $site_root;

 if (!user_isloggedin()) { 
	echo '<a href="' . $site_root . 'hsr-admin/login.php">Login</a>'; 
} else {
	echo '<a href="' . $site_root . 'hsr-admin/login.php">Logout</a>';
}
}

function class_roster($year) {
global $site_root;
	
	echo "<ul>";
	
	$query = "SELECT user_name, first_name, last_name FROM users WHERE grad_year = '$year' ORDER BY last_name";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		echo '<li><a href="' . $site_root . 'hsr-admin/user.php?username=' . $row['user_name'] . '">' . $row['last_name'] . ', ' . $row['first_name'] . '</a></li>';
		}
		
	echo "</ul>";
	
	}
	
function class_link($grad_year) {
global $site_root;

		echo '<a href="' . $site_root . 'hsr-admin/class-roster.php?grad_year=' . $grad_year . '">' . $grad_year . '</a>';
		echo '<br />';

	}
	
function is_adminmessage() {
	$query = "SELECT option_value, option_date FROM options WHERE option_name = 'admin_message' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$message = $row['option_value'];
		}
	if ($message == '') {
		return false;
	} else {
		return true;
	}
}
	
	
function admin_message() {
$query = "SELECT option_value, option_date FROM options WHERE option_name = 'admin_message' LIMIT 1";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	$message = hsrautop($row['option_value']);
	$timestamp = $row['option_date'];
	echo "<span class='post-date'>Posted on: " . date('m/d/Y \@ g:i a', $timestamp) . "</span>";
	echo "<div class='content'>" . $message . "</div>";
	}
}

function welcome_message() {

$query = "SELECT * FROM options WHERE option_name = 'welcome_message'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
	{
	$message = hsrautop($row['option_value']);
	echo "<h1>" . $row['option_description'] . "</h1>";
	echo $message;
	}
}

function is_events() {
	$now = time();
	$query = "SELECT * FROM posts WHERE post_type = 'event' AND due_date > '$now' AND post_status = 'publish'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	
	if ($rows == 0) {
		return false;
	} else {
		return true;
	}
}

function is_userevents() {
	$userid = get_userid();
	
	$query = "SELECT grad_year FROM users WHERE user_id = '$userid' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$year = $row['grad_year'];
		}
		
	$now = time();
	$query = "SELECT * FROM posts WHERE post_type = 'event' AND due_date > '$now' AND event_class = '$year' AND post_status = 'publish'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	
	if ($rows == 0) {
		return false;
	} else {
		return true;
	}
}
	

function user_upcoming_events() {
global $site_root;
	
	echo "<table>";
	echo "<tr>";
	echo "<th>Date</th>";
	echo "<th>Time</th>";
	echo "<th>Event</th>";
	echo "</tr>";
	
	$now = time();
	
	$userid = get_userid();
	
			/* This variable is for alternating comment background */
			$oddcomment = '"alt"';
	$query2 = "SELECT grad_year FROM users WHERE user_id = '$userid' LIMIT 1";
	$result2 = mysql_query($query2);
	while($row2 = mysql_fetch_array($result2)) {
		$year = $row2['grad_year'];
		}
	
	$query = "SELECT * FROM posts WHERE post_type = 'event' AND due_date > '$now' AND event_class = '$year' AND post_status = 'publish' ORDER BY due_date";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		/* Changes every other comment to a different class */ 
		  if ('"alt"' == $oddcomment) $oddcomment = '""';
		  else $oddcomment = '"alt"';  
			$date = $row['due_date'];
			$id = $row['id'];
			  echo "<tr class=" . $oddcomment . ">";
			  echo "<td>" . date('m/d/Y', $date) . "</td>";
			  echo "<td>" . date('g:i a', $date) . "</td>";
			  echo "<td width=\"200\"><a href=\"". $site_root . "index.php?p=" . $id . "\">" . $row['post_title'] . "</a></td>";
			  echo "</tr>";
	
		}
	
	echo "</table>";

}

function upcoming_events() {
global $site_root;

	echo "<table>";
	echo "<tr>";
	echo "<th>Date</th>";
	echo "<th>Time</th>";
	echo "<th>Event</th>";
	echo "</tr>";
	
	$now = time();
	
			/* This variable is for alternating comment background */		
			$oddcomment = '"alt"';
	
	$query = "SELECT * FROM posts WHERE post_type = 'event' AND due_date > '$now' AND post_status = 'publish' ORDER BY due_date";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
		{
		/* Changes every other comment to a different class */	  
		if ('"alt"' == $oddcomment) $oddcomment = '""';
		  else $oddcomment = '"alt"';
		  
		$date = $row['due_date'];
		$id = $row['id'];
		  echo "<tr class=" . $oddcomment . ">";
		  echo "<td>" . date('m/d/Y', $date) . "</td>";
		  echo "<td>" . date('g:i a', $date) . "</td>";
		  echo "<td width=\"200\"><a href=\"". $site_root . "index.php?p=" . $id . "\">" . $row['post_title'] . "</a></td>";
		  echo "</tr>";
		}
	
	echo "</table>";

}


function post_links($home = true) {
global $site_root;



if($home) {
echo "<span><a href=\"" . $site_root . "\">Alumni</a></span>";
}

$query = "SELECT * FROM posts WHERE post_type = 'page'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
	$id = $row['id'];
	$title = $row['post_title'];
	
echo "<span><a href=\"" . $site_root . "index.php?p=" . $id . "\">" . $title . "</a></span>";
	
	}

}

function admin_link() {
global $site_root;

$username = $_COOKIE['user_name'];
	if (!empty($username)) {
	echo "<a href=\"" . $site_root . "hsr-admin/\">Dashboard</a>";
	}
}

function show_links() {
global $site_root;

$query = "SELECT * FROM links";
$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$name = $row['name'];
		$url = $row['URL'];
		$title = $row['description'];
		
	echo "<span><a href=\"" . $url . "\" title=\"" . $title . "\" >" . $name . "</a></span>";
		
	}
}


function user_can($rank) {

	require_once('../hsr-includes/login_funcs.php');
	
	if (!user_isloggedin()) {
		header("Location: login.php");
	}
	
	$user = get_userid();
	
	$query = "SELECT rank, status FROM users WHERE user_id = '$user' LIMIT 1";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$user = $row['rank'];
		$status = $row['status'];
		}
		
	if ($rank >= $user && $status == 'on') {
		return true;
	} else {
		return false;
	}

}


function user_ison($user) {
	
	
	$query = "SELECT status FROM users WHERE user_name = '$user' LIMIT 1";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$status = $row['status'];
		}
		
	if ($status == 'on') {
		return true;
	} else {
		return false;
	}
}

function class_maillist($class) {

	$emails = array();

	$query = "SELECT email FROM users WHERE grad_year = '$class'";
	$result = mysql_query($query);
	$j = mysql_fetch_array($result);
	while($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$emails[] = implode("\t", $row);
		}
	$emails = implode(",", $emails);
	return $emails;
	
}

function echo_class_maillist($class) {

	$emails = array();

	$query = "SELECT email FROM users WHERE grad_year = '$class'";
	$result = mysql_query($query);
	$j = mysql_fetch_array($result);
	while($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$emails[] = implode("\t", $row);
		}
	$emails = implode(",", $emails);
	echo $emails;
	
}

function grad_list($username) {
	$query = "SELECT user_name, grad_year FROM users WHERE user_name = '$username' ORDER BY grad_year DESC";
	$result = mysql_query($query);
	$row_query = mysql_fetch_assoc($result);
	while ($row = mysql_fetch_array($result))  {
		$grad = $row['grad_year'];
	}

	$query_grad_year = "SELECT grad_year FROM users GROUP BY grad_year ORDER BY grad_year DESC";
	$grad_year = mysql_query($query_grad_year);
	$row_grad_year = mysql_fetch_assoc($grad_year);
	$totalRows_grad_year = mysql_num_rows($grad_year);
	?>	
	  <select name="grad_year">
    <?php
do {  
global $grad;
?>
    <option value="<?php echo $row_grad_year['grad_year']?>"<?php if (!(strcmp($row_query['grad_year'], $row_grad_year['grad_year']))) {echo "selected=\"selected\"";} ?>><?php echo $row_grad_year['grad_year']?></option>
    <?php
} while ($row_grad_year = mysql_fetch_assoc($grad_year));
  $rows = mysql_num_rows($grad_year);
  if($rows > 0) {
      mysql_data_seek($grad_year, 0);
	  $row_grad_year = mysql_fetch_assoc($grad_year);
  }
?>
  </select>
<?php  
 }
 
 
function grad_list_register() {
	$query_grad_year = "SELECT grad_year FROM users WHERE grad_year > 1900 GROUP BY grad_year ORDER BY grad_year DESC";
	$grad_year = mysql_query($query_grad_year);
	$row_grad_year = mysql_fetch_assoc($grad_year);
	$totalRows_grad_year = mysql_num_rows($grad_year);
	?>	
	  <select name="grad_year">
    <?php
do {  
global $grad;
?>
    <option value="<?php echo $row_grad_year['grad_year']?>"><?php echo $row_grad_year['grad_year']?></option>
    <?php
} while ($row_grad_year = mysql_fetch_assoc($grad_year));
  $rows = mysql_num_rows($grad_year);
  if($rows > 0) {
      mysql_data_seek($grad_year, 0);
	  $row_grad_year = mysql_fetch_assoc($grad_year);
  }
?>
  </select>
<?php  
 }
 
 
function grad_list_links() {
	$query_grad_year = "SELECT grad_year FROM users WHERE grad_year > 1900 GROUP BY grad_year ORDER BY grad_year DESC";
	$grad_year = mysql_query($query_grad_year);
	$row_grad_year = mysql_fetch_assoc($grad_year);
	$totalRows_grad_year = mysql_num_rows($grad_year);
	?>	
	  <select name="jump1">
    <?php
do {  
global $grad;
?>
    <option value="<?php echo 'class-roster.php?grad_year=' . $row_grad_year['grad_year']?>"><?php echo $row_grad_year['grad_year']?></option>
    <?php
} while ($row_grad_year = mysql_fetch_assoc($grad_year));
  $rows = mysql_num_rows($grad_year);
  if($rows > 0) {
      mysql_data_seek($grad_year, 0);
	  $row_grad_year = mysql_fetch_assoc($grad_year);
  }
?>
  </select>
  <input type="button" name="Button1" value="Go" onclick="MM_jumpMenuGo('jump1','parent',0)" />
<?php  
}
 
 
function no_leaders() {
$leaders = array();
	$query = "SELECT * FROM users WHERE rank = '3' AND status = 'on' GROUP BY grad_year ORDER BY grad_year";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$leaders[] = $row['grad_year'];
		}
$leaders = implode(' AND grad_year != ', $leaders);
		
$leaders1 = array();
	$query1 = "SELECT * FROM users WHERE rank = '4' AND grad_year != $leaders AND status = 'on' GROUP BY grad_year ORDER BY grad_year";
	$result1 = mysql_query($query1);
	while ($row1 = mysql_fetch_array($result1)) {
		$leaders1[] = $row1['grad_year'];
		}
$leaders1 = implode(', ', $leaders1);
echo $leaders1;
		}
//check for broken themes 		
function valid_theme($theme) {
	$index = '../hsr-content/themes/'.$theme.'/index.php';
	$page = '../hsr-content/themes/'.$theme.'/page.php';
	if (!file_exists($index)) {
		return false;
	} elseif(!file_exists($page)) {
		return false;
	} else {
		return true;
	}
}

function current_theme() {
$query = "SELECT * FROM options WHERE option_name = 'theme'";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$theme = $row['option_value'];
	}
	return $theme;
}

function stylesheet_dir() {
	global $site_url;
	$url = $site_url . 'hsr-content/themes/' . current_theme() . '/';
	return $url;
	}

// GET FUNCTIONS
function get_userid() {
$user = $_COOKIE['user_name'];

$query = "SELECT user_id FROM users WHERE user_name = '$user' LIMIT 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$id = $row['user_id'];
	}

return $id;
}

function get_theclass() {
$user = get_userid();

$query = "SELECT grad_year FROM users WHERE user_id = '$user' LIMIT 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$class = $row['grad_year'];
	}

return $class;
}

function get_useremail() {
$user = get_userid();

$query = "SELECT email FROM users WHERE user_id = '$user' LIMIT 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$email = $row['email'];
	}

return $email;
}

function get_userfirstname() {
$id = get_userid();
$query = "SELECT first_name FROM users WHERE user_id = '$id' LIMIT 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$first = $row['first_name'];
	}

return $first;
}

function get_userlastname() {
$id = get_userid();
$query = "SELECT last_name FROM users WHERE user_id = '$id' LIMIT 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$last = $row['last_name'];
	}

return $last;
}

function get_userfirstlastname() {
$name = get_userfirstname() . ' ' . get_userlastname();
return $name;
}

function get_stylecolors($level = 'primary') {
	if($level == 'primary') {
		$name = 'dark_color';
	} elseif($level == 'secondary') {
		$name = 'light_color';
	} else {
		header("Location: custom-styles.php");
	}
	
	$query = "SELECT option_value FROM options WHERE option_name = '$name' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$color = $row['option_value'];
		}
	return $color;
}

//Get the Logo URL
function get_currentlogourl() {
	global $site_root;
	$url = "hsr-content/uploads/logos/";
	$url = $site_root . $url;
	
	$query = "SELECT option_value FROM options WHERE option_name = 'logo' LIMIT 1";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$logo = $row['option_value'];
	}
	
	$url = $url . $logo;
	
	return $url;
	
}

//Is there a logo?
function is_logo() {
	$query = "SELECT option_value FROM options WHERE option_name = 'logo' LIMIT 1";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$logo = $row['option_value'];
	}

	if ($logo == 'none') {
		return false;
	} else {
		return true;
	}
}

//Get the logo
function get_currentlogo() {
	if(is_logo()) {
		$code = '<img src="' . get_currentlogourl() . '" alt="Logo" />';
	} else {
		$code = '<h4>There is currently no Logo selected';
	}
	
	return $code;
}


//Decide Style Preset or Custom
function displaystylethumb() {
	$query = "SELECT option_value FROM options WHERE option_name = 'dark_color' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$dark = $row['option_value'];
	}
	
	$query = "SELECT option_value FROM options WHERE option_name = 'light_color' LIMIT 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$light = $row['option_value'];
	}
	
	switch($dark) {
		case '#CC0000':
			$dark = 'red';
		break;
		case '#0000FF':
			$dark = 'blue';
		break;
		case '#006600':
			$dark = 'green';
		break;
		case '#990000':
			$dark = 'maroon';
		break;
		case '#FFFFFF':
			$dark = 'white';
		break;
		default:
			$dark = 'custom';
		break;
		}
		
	switch($light) {
		case '#FF0000':
			$light = 'red';
		break;
		case '#FFFFFF':
			$light = 'white';
		break;
		case '#FFFF00':
			$light = 'yellow';
		break;
		case '#000000':
			$light = 'black';
		break;
		default:
			$light = 'custom';
		break;
		}
		
		$combined = $dark . '-' . $light;
		
		switch($combined) {
			case 'blue-white':
			case 'blue-yellow':
			case 'green-white':
			case 'green-yellow':
			case 'maroon-red':
			case 'maroon-white':
			case 'red-red':
			case 'red-white':
			case 'white-black':
				$code = '<img src="img/style-swatches/' . $combined . '.png" alt="' . $combined . '" />';
			break;
			default:
				$code = '<h4>Custom Style is Active</h4>';
			break;
		}
			
		return $code;
	}

function list_poststatus($id) {
	$query = "SELECT post_status FROM posts WHERE id = '$id'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result))  {
		$status = $row['post_status'];
	}
	?>	
	  <select name="status">
    <option value="draft" <?php if ($status == 'draft') {echo "selected=\"selected\"";} ?>>Draft</option>
    <option value="review" <?php if ($status == 'review') {echo "selected=\"selected\"";} ?>>Review</option>
    <option value="publish" <?php if ($status == 'publish') {echo "selected=\"selected\"";} ?>>Publish</option>
  </select>
<?php  
 }

?>