<?php
	// Require codebird
	require_once('codebird-php/src/codebird.php');
	// Require authentication parameters
	require_once('twitter_config.php');
	
	// Set connection parameters and instantiate Codebird	
	\Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken($access_token, $access_token_secret);
	
	$reply = $cb->oauth2_token();
	$bearer_token = $reply->access_token;
	
	// App authentication
	\Codebird\Codebird::setBearerToken($bearer_token);
		
	// Create query
	// TODO
		
	// Make the REST call
	// TODO
	
	// Convert results to an associative array
	// TODO
		
	// Optionally, store results in a file
	//file_put_contents("single_mu.json", json_encode($res));
	
	echo "<img src=\"".IMAGE."\"/>"; //getting the profile image
	echo "Name: ".NAME."<br/>"; //getting the username
	echo "Web: ".WEB."<br/>"; //getting the web site address
	echo "Location: ".LOCATION."<br/>"; //user location
	echo "Updates: ".UPDATES."<br/>"; //number of updates
	echo "Follower: ".FOLLOWER."<br/>"; //number of followers
	echo "Following: ".FOLLOWING."<br/>"; // following
	echo "Description: ".DESCRIPTION."<br/>"; //user description
	
	echo '<br/>';
	echo '<br/>';
	
	// Show tweets with media
		
?>
 