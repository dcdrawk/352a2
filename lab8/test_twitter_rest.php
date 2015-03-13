<?php
	ini_set('display_errors', 1);
	
	// Include TwitterAPIExchange 
	require_once('TwitterAPIExchange.php');
	echo "<h2> Simple Twitter Application</h2>";
	
	// Set user parameters
	//	- consumer key,
	// 	- consumer secret,
	//	- access token, and
	//	- access token secret
	$consumer_key = "kkAnGMgcGthveft1nPkJS3kzc";
	$consumer_secret = "ftjJA1COjniEEiTqUEzrLLwwNBblEWaTGNvqbs36uZZXHwKkJR";
	$access_token = "581316147-HzLgx7h547XA6E28DdcGzOxh4pMowa9RUBF7A2TM";
	$access_token_secret = "Dmc2IWm4iFYyTN8lVAnQta18sd85zrxCfnRr3hZ7u6a3F";
	
	// Configure user parameters using Twitter wrapper
	$settings = array(
		'oauth_access_token' => $access_token,
		'oauth_access_token_secret' => $access_token_secret,
		'consumer_key' => $consumer_key,
		'consumer_secret' => $consumer_secret
	);
	
	// Define REST method
	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	// Define request method (GET or POST)
	$requestMethod = 'GET';

	$getfield = '?screen_name=ManUtd';

	// Create new instance of Twitter PHP wrapper
	$twitter = new TwitterAPIExchange($settings);
		
	// Execute Twitter REST request and decode response to JSON
	$string = json_decode($twitter->setGetfield($getfield)
								->buildOauth($url, $requestMethod)
								->performRequest(),$assoc = TRUE);
	
	$name = $string[0]['user']['name'];
	$tweet = $string[0]['text' ];
	$Pic =  $string[0]['user']['profile_image_url'];
	
	echo "<B>Team name: </B>" .$name. "<BR> <HR>";
	// echo "<B>Team Tweet :" .$tweet. "<BR>";
	
// Define query parameters - 20 most recent tweets for ManUtd
	for ($x = 0; $x <20; $x++) 
		{
			$tweet = $string[$x]['text' ];	
			echo  " <B> Tweet " .$x. ": </B>"  .$tweet. "<br> <HR>";	
		}

		
	
	// Display everything from the api
	echo "<pre>";
	print_r($string);
	echo "</pre>";

	
	// Print obtained messages

	/*
	 if($string['errors'] = "Array") 
	 {
		echo "<h3> Sorry, there was a problem.</h3> <p>Twitter returned the following error message:</p>";
		echo $string['errors'][0]['message'];
		exit();
	 }
	*/


?>