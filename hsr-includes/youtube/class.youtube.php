<?php

/*		
	YouTube API hack up.  
	Version: 1.0 
	Author: Sam Napolitano
	URL: http://www.napolitopia.com/youtube_videos.php
	Last Mod Date: 9/22/06
	Notes: I am relatively new to php so you will have to excuse me if it seems that this is a little redundant or undercoded. 
	This is also the first class I have ever created from scratch, so the concept is still new to me. 
	This is under a GNU just leave my name in the credits and use/hack/destroy as needed. 
*/

class youTube {

	function get_feed($feed){
		
		//Open and return Feed with cURL for parsing
		$ch = curl_init();
		$timeout = 0;
		curl_setopt ($ch, CURLOPT_URL, $feed);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$xml = curl_exec($ch);
		curl_close($ch);
		
		return $xml;

	}
	
	function yt_results($xml, $howmany){
	
		//Match appropriate tags and throw them in an array. I know I don't need to escape the carrots but I was recieving some strange results without it.
		preg_match_all("/\<url\>(.+?)\<\/url\>/smi",$xml, $url);
		preg_match_all("/\<title\>(.+?)\<\/title\>/smi",$xml, $title);
		preg_match_all("/\<description\>(.+?)\<\/description\>/smi",$xml, $description);
		preg_match_all("/\<video\>(.+?)\<\/video\>/smi",$xml, $video);
		preg_match_all("/\<thumbnail_url\>(.+?)\<\/thumbnail_url\>/smi",$xml, $thumb_nail);
		
		//shift return arrays to negate 0 level
		array_shift($url);
		array_shift($title);
		array_shift($thumb_nail);
		array_shift($description);
		array_shift($video);
		
		// Replace html characters. More can be added but this seems to work for me across the board. 
		for($i=0;$i<count($description[0]);$i++){
			
			$description[0][$i] = preg_replace("/&#60;/","<",$description[0][$i]);
			$description[0][$i] = html_entity_decode($description[0][$i],ENT_QUOTES);
		
		}
		
		// find out how many videos are returned
		$total_videos = count($video[0]);
		
		//error checking for how many videos to display
		
		//if more videos are asked for then exist only return how many acutally exist
		if($howmany > $total_videos){
			
			$howmany = $total_videos;
		
		}
		
		//if none are asked for default to all
		if(!$howmany || $howmany == 0){
		
			$howmany = $total_videos;
			
		}
		
		//video display options
		for($i = 0; $i<$howmany; $i++){
			
			print "<p><h3>".$title[0][$i]."</h3><a href=\"".$url[0][$i]."\" target=\"_blank\"><img src=\"".$thumb_nail[0][$i]."\"></a></p>"; 
		
		}
	}

	function yt_featured($dev_id, $howmany){
		
		//youTube api feed
		$feed = "http://www.youtube.com/api2_rest?method=youtube.videos.list_featured&dev_id=$dev_id";
		
		//get the feed as a string data source
		$xml = $this->get_feed($feed);
		
		//get results
		$this->yt_results($xml, $howmany);	
		
	}
	
	function yt_user($dev_id, $user, $howmany){
		
		//youTube api feed
		$feed = "http://www.youtube.com/api2_rest?method=youtube.videos.list_by_user&dev_id=$dev_id&user=$user";
		
		//get the feed as a string data source
		$xml = $this->get_feed($feed);
		
		//get results
		$this->yt_results($xml, $howmany);
		
	}
	
	function yt_tag($dev_id, $tag, $howmany){
		
		//youTube api feed
		$feed = "http://www.youtube.com/api2_rest?method=youtube.videos.list_by_tag&dev_id=$dev_id&tag=$tag";
		
		//get the feed as a string data source
		$xml = $this->get_feed($feed);	
		
		//get results
		$this->yt_results($xml, $howmany);	
		
		
	}
	
}

?>
