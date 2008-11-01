<?php

/***********************************************
 * This file displays the change non-sensitive *
 * user data form.  It submits to itself, and  *
 * displays a message each time you submit	   *
 ***********************************************/
 
require_once('../hsr-config.php');
include_once('header_footer.php');
include_once('../hsr-includes/login_funcs.php');

if (user_can(3)) {
		$user_name = $_COOKIE['user_name'];
		if ($_POST['submit'] == "Save") {
		// Send data to db
		
		// I'm not bothering to check the stringlength of these
		// because I'm URL-encoding them
		$as_address = addslashes($_POST['address']);
		$as_city = addslashes($_POST['city']);
		$as_state = addslashes($_POST['state']);
		$as_country = addslashes($_POST['country']);
		$as_zip = addslashes($_POST['zip']);
		$as_home_phone = addslashes($_POST['home_phone']);
		$as_cell_phone = addslashes($_POST['cell_phone']);
		$as_work_phone = addslashes($_POST['work_phone']);
		$as_work_ext = addslashes($_POST['work_ext']);
		$as_photo_url = addslashes($_POST['photo_url']);
		$ue_photo_url = urlencode($as_photo_url);
		$as_homepage_url = addslashes($_POST['homepage_url']);
		$ue_homepage_url = urlencode($as_homepage_url);
		$as_fav_link1 = addslashes($_POST['fav_link1']);
		$ue_fav_link1 = urlencode($as_fav_link1);
		$as_fav_link2 = addslashes($_POST['fav_link2']);
		$ue_fav_link2 = urlencode($as_fav_link2);
		$as_fav_link3 = addslashes($_POST['fav_link3']);
		$ue_fav_link3 = urlencode($as_fav_link3);
		$as_fname = addslashes($_POST['fname']);
		$as_mname = addslashes($_POST['mname']);
		$as_lname = addslashes($_POST['lname']);
		$as_gradyr = addslashes($_POST['grad_year']);
		
		//Don't display http:// as a link
		if ($_POST['photo_url'] == 'http://') {
			$ue_photo_url = '';
		}
		if ($_POST['homepage_url'] == 'http://') {
			$ue_homepage_url = '';
		}
		if ($_POST['fav_link1'] == 'http://') {
			$ue_fav_link1 = '';
		}
		if ($_POST['fav_link2'] == 'http://') {
			$ue_fav_link2 = '';
		}
		if ($_POST['fav_link3'] == 'http://') {
			$ue_fav_link3 = '';
		}
		
		$query = "UPDATE users
				SET first_name = '$as_fname',
					maiden_name = '$as_mname',
					last_name = '$as_lname',
					grad_year = '$as_gradyr',
					address = '$as_address',
					city = '$as_city',
					state = '$as_state',
					country = '$as_country',
					zip = '$as_zip',
					home_phone = '$as_home_phone',
					cell_phone = '$as_cell_phone',
					work_phone = '$as_work_phone',
					work_ext = '$as_work_ext',
					photo = '$ue_photo_url',
					homepage = '$ue_homepage_url',
					link1 = '$ue_fav_link1',
					link2 = '$ue_fav_link2',
					link3 = '$ue_fav_link3'
				WHERE user_name = '$user_name'";
		$result = mysql_query($query);
		if (!$result) {
			$status_message = 'Problem with user data entry';
		} else {
			$status_message = 'Successfully edited user data';
		}
	}

	
	// Get previously-existing data
	$query = "SELECT first_name, maiden_name, last_name, grad_year, address, city, state, country, zip, home_phone, cell_phone, work_phone, work_ext, photo, homepage, link1, link2, link3
			FROM users
			WHERE user_name = '$user_name'";
			
	$result = mysql_query($query);
	// Shall we have an error message if no data comes back?
	$user_array = mysql_fetch_array($result);
	$fname = stripslashes($user_array['first_name']);
	$mname = stripslashes($user_array['maiden_name']);
	$lname = stripslashes($user_array['last_name']);
	$address = stripslashes($user_array['address']);
	$city = stripslashes($user_array['city']);
	$state = stripslashes($user_array['state']);
	$country = stripslashes($user_array['country']);
	$zip = stripslashes($user_array['zip']);
	$home_phone = stripslashes($user_array['home_phone']);
	$cell_phone = stripslashes($user_array['cell_phone']);
	$work_phone = stripslashes($user_array['work_phone']);
	$work_ext = stripslashes($user_array['work_ext']);
	$photo_url = urldecode($user_array['photo']);
	$photo_url = stripslashes($photo_url);
	$homepage_url = urldecode($user_array['homepage']);
	$homepage_url = stripslashes($homepage_url);
	$fav_link1 = urldecode($user_array['link1']);
	$fav_link1 = stripslashes($fav_link1);
	$fav_link2 = urldecode($user_array['link2']);
	$fav_link2 = stripslashes($fav_link2);
	$fav_link3 = urldecode($user_array['link3']);
	$fav_link3 = stripslashes($fav_link3);
	
	//Display http:// if there is no link saved
	if($photo_url == '') {
		$photo_url = 'http://';
	}
	if($homepage_url == '') {
		$homepage_url = 'http://';
	}
	if($fav_link1 == '') {
		$fav_link1 = 'http://';
	}
	if($fav_link2 == '') {
		$fav_link2 = 'http://';
	}
	if($fav_link3 == '') {
		$fav_link3 = 'http://';
	}
			
			// --------------
			// Construct Form
			// --------------
			
			site_head('User data edit page');
			$username = $_COOKIE['user_name'];
			
?>			
<?php optionnav(); ?>
			<p><font color="#ff0000"><?php echo $status_message; ?></font></p>
			
			<form action="edit-userinfo.php" method="post">
			<h2>User Info</h2>
			<p class=left>
			<b>First Name</b><br />
			<input type="text" name="fname" value="<?php echo $fname; ?>" size="40">
			</p>
            <b>Maiden Name</b><br />
			<input type="text" name="mname" value="<?php echo $mname; ?>" size="40">
			</p>
			<p class=left>
			<b>Last Name</b><br />
			<input type="text" name="lname" value="<?php echo $lname; ?>" size="40">
			</p>
	<p class=left><b>Graduation Year</b><br />

    <?php grad_list($username); ?>

	     </p>
	  <input type="submit" name="submit" value="Save">
			<h2>Contact Info</h2>
			<p class=left>
			<b>Address</b><br />
			<input type="text" name="address" value="<?php echo $address; ?>" size="40">
			</p>
			<p class=left>
			<b>City</b><br />
			<input type="text" name="city" value="<?php echo $city; ?>" size="40">	
			</p>
			<p class=left>
			<b>State/Province</b><br />
			<input type="text" name="state" value="<?php echo $state; ?>" size="40">
			</p>	
			<p class=left>
			<b>Country</b><br />
			<input type="text" name="country" value="<?php echo $country; ?>" size="40">
			</p>	
			<p class=left>
			<b>Zip Code</b><br />
			<input type="text" name="zip" value="<?php echo $zip; ?>" size="10">	
			</p>
			<p class=left>
			<b>Home Phone</b><br />
			<input type="text" name="home_phone" value="<?php echo $home_phone; ?>" size="15">	
			</p>
			<p class=left>
			<b>Cell Phone</b><br />
			<input type="text" name="cell_phone" value="<?php echo $cell_phone; ?>" size="15">	
			</p>
			<p class=left>
			<b>Work Phone</b><br />
			<input type="text" name="work_phone" value="<?php echo $work_phone; ?>" size="15">	Ext. <input type="text" name="work_ext" value="<?php echo $work_ext; ?>" size="5">
			</p>
			<p>
			<input type="submit" name="submit" value="Save">
			</p>
			
			<h2>User Info</h2>
			<p class=left>
			<b>Photo URL</b> (i.e. http://www.flickr.com/photos/username/)<br />
			<input type="text" name="photo_url" value="<?php echo $photo_url; ?>"
				size="40">
			</p>
			<p class=left>
			<b>Homepage URL</b> (i.e. http://mysite.com/)<br />
			<input name="homepage_url" type="text" value="<?php echo $homepage_url; ?>"
				size="40">
			</p>
			<p class=bold>Favorite Links<br />
			<input name="fav_link1" type="text" value="<?php echo $fav_link1; ?>"
				size="40">
			<p>
			<input name="fav_link2" type="text" value="<?php echo $fav_link2; ?>"
				size="40">
			</p>
			<p>
			<input name="fav_link3" type="text" value="<?php echo $fav_link3; ?>"
				size="40">
			</p>
			<p>
			<input type="submit" name="submit" value="Save">
			</p>
			</form>
<?php site_footer(); ?>

<?php 
} else {
echo "You're not allowed to do that!";
} 
?>