<?php

	require_once('class.youtube.php');
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>YouTube Feed Ripper Version 1.0 by Sam Napolitano</title>
</head>

<body>

<?php

// Usage is like a basic class, just start a new instance.
$yt = new youTube;

//Get Featured Videos. Just plug in your dev ID and tell the script how many videos you want to return. If you specify 0 or none at all it will defaul to all videos. 
//Additionally if you specifiy 26 and only 25 videos are found it will only return 25 videos. 
print "<p>Featured videos: </p>";
$yt->yt_featured("YOUR_DEV_ID", 3);

//Get Users videos.  Just input dev ID user name and how many you want returned
print "<p>Users videos: </p>";
$yt->yt_user("YOUR_DEV_ID", "taylorrobinson", 3);

//Get by tag.  This proves to be the most interseting return.  you could throw this in a form and change the term based on a user search.  
// Again just add dev ID, search term, can have spaces, and how many you want returned.   
print "<p>Videos by tag: </p>";
$yt->yt_tag("YOUR_DEV_ID", "paintball", 3);

?>

<a href="http://www.napolitopia.com/">Sam Napolitano</a>
</body>
</html>
