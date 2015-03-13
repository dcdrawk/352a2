<?php
	// Require codebird
	require_once('codebird-php/src/codebird.php');
	// Require authentication parameters
	require_once('twitter_auth.php');
	
	// Set connection parameters and instantiate Codebird	
	\Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken($access_token, $access_token_secret);
	
	$reply = $cb->oauth2_token();
	$bearer_token = $reply->access_token;
	
	// App authentication
	\Codebird\Codebird::setBearerToken($bearer_token);
		
	// Create query
	$params = array(
		'screen_name' => 'ManUtd',	
		'count' => 10,
		'include_entities' => 'true',
		'include_rts' => 'true',		
		'since' => '2014-01-31',
		'until' => '2014-06-31',		
	);			
		
	// Make the REST call
	$res = (array) $cb->statuses_userTimeline($params);	
	// Convert results to an associative array	
	$data = json_decode(json_encode($res), true);
		
	// Optionally, store results in a file
	file_put_contents("data.json", json_encode($res));
	
	echo 'completed';
	echo "<img src=\"".$data['0']['user']['profile_image_url']."\"/>"; //getting the profile image
	echo "Name: ".$data['0']['user']['name']."<br/>"; //getting the username
	echo "Web: ".$data['0']['user']['url']."<br/>"; //getting the web site address
	echo "Location: ".$data['0']['user']['location']."<br/>"; //user location
	echo "Updates: ".$data['0']['user']['statuses_count']."<br/>"; //number of updates
	echo "Follower: ".$data['0']['user']['followers_count']."<br/>"; //number of followers
	echo "Following: ".$data['0']['user']['friends_count']."<br/>"; // following
	echo "Description: ".$data['0']['user']['description']."<br/>"; //user description
	
	echo '<br/>';
	echo '<br/>';
	foreach ($data as $item){
		echo '<p>';
			echo $item['text'];
			echo '<br/>';
			if(!empty($item['entities']['media']['0']['media_url'])){
				echo "<img src=\"".$item['entities']['media']['0']['media_url']."\" width=\"200\" height=\"200\"/>"; //getting the profile image
			}
		echo '</p>';
		echo '<br/>';
	}	
?>
 