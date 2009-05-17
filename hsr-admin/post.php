<?php

require_once('../hsr-config.php');

if (user_can(3)) {

	$type = $_REQUEST['type'];
	
	switch($type) {
	
		case 'class_email':
		
		$sender = get_useremail();

		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$address = class_maillist(get_theclass());
		$noreply = noreply();
		$headers = "From: $noreply";

		mail($address, $subject, $message, $headers);
		
		header("Location: email-class.php");
		
		break;
		
		case 'user':
		global $hash_padding;
		
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$grad = $_POST['grad_year'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$hash = md5($email . $hash_padding);
		
		if ($password1 == $password2) {
			$crypt_pwd = md5($password1 . $hash_padding);		
		$query = "INSERT INTO users (user_name, first_name, maiden_name, last_name, grad_year, password, email, status, rank, remote_addr, confirm_hash, is_confirmed, date_created)
			VALUES ('$username', '$firstname', '', '$lastname', '$grad', '$crypt_pwd', '$email', 'on', '3', '$user_ip', '$hash', '1', NOW())";
		$result = mysql_query($query);
		
		header("Location: new-user.php");
		} else {
			include('header_footer.php');

			site_head('Error!');
			
			echo "<h4 align='center'>ERROR: The passwords you entered were not the same. Please go back and type the same password twice.</h4>";
			
			site_footer();	
		}		
	
		break;
		
	 case 'user-edit':
	 global $hash_padding;
		
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$maidname = $_POST['maidname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$rank = $_POST['rank'];
		$status = $_POST['status'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if ($id == 1) {
			$rank = 1;
			$status = 'on';
			}
			
		$query = "UPDATE users 
			SET first_name = '$firstname',
				maiden_name = '$maidname',
				last_name = '$lastname',
				email = '$email',
				rank = '$rank',
				status = '$status'
			WHERE user_id = '$id'";
		$result = mysql_query($query);
		
		if (!empty($password1)) {
			if ($password1 == $password2) {
			$crypt_pwd = md5($password1.$hash_padding);
			$query2 = "UPDATE users
				SET password = '$crypt_pwd'
				WHERE user_id = '$id'";
			$result2 = mysql_query($query2);
				header("Location: manage-users.php");
			} else {
			
				include('header_footer.php');

				site_head('Error!');
				
				echo "<h4 align='center'>ERROR: The passwords you entered were not the same. Please go back and type the same password twice.</h4>";
				
				site_footer();
				}		
		} else {
			header("Location: edit-user.php?id=$id");
		}
		
		break;
		
		case 'link':
		if(!empty($_POST['title']) &&
		!empty($_POST['url'])) {
		
		if (!empty($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$description = '';
		}
		
		$title = $_POST['title'];
		$url = $_POST['url'];
		
		$query = "INSERT INTO links (name, description, URL, author)
			VALUES ('$title', '$description', '$url', '1')";
		$result = mysql_query($query);
		
		header("Location: new-link.php");
		}
		break;
		
		case 'link-edit':
		if (!empty($_POST['title']) &&
		!empty($_POST['url'])) {
		
				if (!empty($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$description = '';
		}
		
		$title = $_POST['title'];
		$url = $_POST['url'];
		$id = $_POST['id'];
		
		$query = "UPDATE links 
			SET name = '$title',
				description = '$description',
				URL = '$url'
			WHERE id = '$id'";
		$result = mysql_query($query);
		
		header("Location: manage-links.php");
		}
		break;
		
		case 'edit':
		
		if (!empty($_POST['title']) && 
		!empty($_POST['content'])) {
		
		$title = $_POST['title'];
		$content = $_POST['content'];
		$min = $_POST['min'];
		$monthtext = $_POST['month'];
		$day = $_POST['day'];
		$yr = $_POST['yr'];
		$class = $_POST['class'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		if ($_POST['ampm'] == 'am') {
			$ampm = 0;
		} elseif ($_POST['ampm'] == 'pm') {
			$ampm = 12;
		}
		
		if ($_POST['hr'] == 12 && $ampm == 0) {	
			$hr = '0';
		} elseif ($_POST['hr'] == 12 && $ampm == 12) {
			$hr = '12';
		} else {		
			$hr = ($_POST['hr'] + $ampm);
		}
		
		switch($monthtext) {
			
			case 'January':
				$month = 1;
			break;
			
			case 'February':
				$month = 2;
			break;
			
			case 'March':
				$month = 3;
			break;
			
			case 'April':
				$month = 4;
			break;
			
			case 'May':
				$month = 5;
			break;
			
			case 'June':
				$month = 6;
			break;
			
			case 'July':
				$month = 7;
			break;
			
			case 'August':
				$month = 8;
			break;
			
			case 'September':
				$month = 9;
			break;
			
			case 'October':
				$month = 10;
			break;
			
			case 'November':
				$month = 11;
			break;
			
			case 'December':
				$month = 12;
			break;
		}
		$due_date = mktime($hr, $min, 0, $month, $day, $yr);
		$query = "UPDATE posts
			SET post_title = '$title',
			post_content = '$content',
			post_status = '$status',
			event_class = '$class',
			due_date = '$due_date'
			WHERE id = '$id'";
		$result = mysql_query($query);
	header("Location: manage-posts.php");
	}
	break;
	
	case 'page':	
	if (!empty($_POST['title']) && 
		!empty($_POST['content'])) {
		
		$title = $_POST['title'];
		$content = $_POST['content'];
		$slug = sanitize_title($_POST['title']);
		$query = "INSERT INTO posts (post_author, post_date, event_class, post_title, post_slug, post_content, post_type, due_date)
				VALUES ('1', NOW(), '0', '$title', '$slug', '$content', 'page', '0')";
		$result = mysql_query($query);
		header("Location: new-page.php");
		}
		break;
		
		case 'event':
		
		if (!empty($_POST['title']) && 
			!empty($_POST['content'])) {	
		
		$id = get_userid();
		$title = $_POST['title'];
		$content = $_POST['content'];
		$min = $_POST['min'];
		$month = $_POST['month'];
		$day = $_POST['day'];
		$yr = $_POST['yr'];
		$class = $_POST['class'];
		$slug = sanitize_title($_POST['title']);
		
		switch($month) {
			
			case 'January':
				$month = 1;
			break;
			
			case 'February':
				$month = 2;
			break;
			
			case 'March':
				$month = 3;
			break;
			
			case 'April':
				$month = 4;
			break;
			
			case 'May':
				$month = 5;
			break;
			
			case 'June':
				$month = 6;
			break;
			
			case 'July':
				$month = 7;
			break;
			
			case 'August':
				$month = 8;
			break;
			
			case 'September':
				$month = 9;
			break;
			
			case 'October':
				$month = 10;
			break;
			
			case 'November':
				$month = 11;
			break;
			
			case 'December':
				$month = 12;
			break;
		}
		
		// Fix midnight and noon selections
		if ($_POST['hr'] == 12 && $_POST['ampm'] == 0) {	
			$hr = '0';
		} elseif ($_POST['hr'] == 12 && $_POST['ampm'] == 12) {
			$hr = '12';
		} else {		
			$hr = ($_POST['hr'] + $_POST['ampm']);
		}
		
		// Create timestamp
		$due_date = mktime($hr, $min, 0, $month, $day, $yr);
		
		// Save to database
		$query = "INSERT INTO posts (post_author, post_date, post_status, event_class, post_title, post_slug, post_content, post_type, due_date)
				VALUES ('$id', NOW(), 'review', '$class', '$title', '$slug', '$content', 'event', '$due_date')";
		$result = mysql_query($query);
		
		// Post ID
		$post_id = mysql_insert_id();
		
		// Mail to admin
		$email = adminemail();
		$body = newevent_msg($id);
		$subject = "New Event Added";
		mailer($email, $subject, $body);
		
		// Mail if box is checked
		if ($_POST['email'] == 'checked') {
			$subject = $title;
			$message = "Your Class has Scheduled a New Event - ". $class ."\n" . date('m/d/Y \@ g:i a', $due_date) . "\n\n" . $content;
			$address = class_maillist($class);
			$noreply = noreply();
			$headers = "From:" . $noreply;
			mail($address, $subject, $message, $headers);		
		}
			
		header("Location: new-event.php");
		}
		break;
		
		case 'uploader':
		
		$target_path = "../hsr-content/uploads/logos/";
		$target_path = $target_path . basename($_FILES['uploadedfile']['name']);
		if (substr($target_path, -4) == '.jpg' || substr($target_path, -4) == '.bmp' || substr($target_path, -4) == '.png' || substr($target_path, -4) == '.gif' || substr($target_path, -5) == '.jpeg') {
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
				header("Location: logo.php");
			} else {
				echo "There was an error uploading the file, please try again!";
			}
		} else {
			echo 'That filetype is not allowed. Please upload .jpg, .bmp, .png, or .gif files only.';
		}
		
		break;
		
		case 'invite': 
		
		$email = $_POST['email'];
		$subject = get_userfirstlastname() . ' wants you to join';
		$message = $_POST['message'];
		$message .= '<p><a href="' . siteroot() . 'hsr-admin/register.php">' . siteroot() . 'hsr-admin/register.php</a></p>';
		$content = '<html><body>' . $message . '</body></html>';
		$noreply = noreply();
		$headers = 'From: ' . $noreply . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html charset=iso-8859-1' . "\r\n";
		
		mail($email, $subject, $content, $headers);
		
		header('Location: invite.php');
		
		break;
			
		default:	
		
		include('header_footer.php');
		
		site_head('Error!');	
		
		echo "<h4 align='center'>ERROR: You have failed to include the Title or the content... We cannot continue without it.</h4>";
			
		site_footer();
		
		break;	
		}
		
} else {
echo "You can't do that... Login first.";
}

?>