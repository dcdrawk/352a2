<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	// Require codebird
    require_once('codebird-php/src/codebird.php');
	// Require authentication parameters
	require_once('twitter_config.php');
////	
//	// Set connection parameters and instantiate Codebird	
	\Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
//	$cb->setToken($access_token, $access_token_secret);
////	
//	$reply = $cb->oauth2_token();
//	$bearer_token = $reply->access_token;
////	
	// App authentication
//	\Codebird\Codebird::setBearerToken($bearer_token);
    
//$reply = $cb->statuses_update('status=Whohoo, I just tweeted!');
//$reply = (array) $cb->statuses_homeTimeline();
//print_r($reply);
//		
//	// Create query
//	$params = array(
//		'screen_name' => 'ManUtd',	
//		'count' => 5
//	);	
//		
//	// Make the REST call
//	$res = (array) $cb->statuses_userTimeline($params);
//	// Convert results to an associative array
//	$data = json_decode(json_encode($res), true);
//		
//	// Optionally, store results in a file
//	//file_put_contents("single_mu.json", json_encode($res));
//	
//	echo "<img src=\"".$data['0']['user']['profile_image_url']."\"/>"; //getting the profile image
//	echo "Name: ".$data['0']['user']['name']."<br/>"; //getting the username
//	echo "Web: ".$data['0']['user']['url']."<br/>"; //getting the web site address
//	echo "Location: ".$data['0']['user']['location']."<br/>"; //user location
//	echo "Updates: ".$data['0']['user']['statuses_count']."<br/>"; //number of updates
//	echo "Follower: ".$data['0']['user']['followers_count']."<br/>"; //number of followers
//	echo "Following: ".$data['0']['user']['friends_count']."<br/>"; // following
//	echo "Description: ".$data['0']['user']['description']."<br/>"; //user description
//	
//	echo '<br/>';
//	echo '<br/>';
//	foreach ($data as $item){
//		echo '<p>';
//			echo $item['text'];
//			echo '<br/>';
//			if(!empty($item['entities']['media']['0']['media_url'])){
//				echo "<img src=\"".$item['entities']['media']['0']['media_url']."\" width=\"200\" height=\"200\"/>"; //getting the profile image
//			}
//		echo '</p>';
//		echo '<br/>';
//	}
?>
 
<?php
session_start();

    if (! isset($_SESSION['oauth_token'])) {
        // get the request token
        $reply = $cb->oauth_requestToken(array(
            'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
        ));

        // store the token
        $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
        $_SESSION['oauth_token'] = $reply->oauth_token;
        $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
        $_SESSION['oauth_verify'] = true;
        
        // store the token
        $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
        $_SESSION['oauth_token'] = $reply->oauth_token;
        $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
        $_SESSION['oauth_verify'] = true;

        // redirect to auth website
        $auth_url = $cb->oauth_authorize();
        header('Location: ' . $auth_url);
        die();

    } elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
        // verify the token
        $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        unset($_SESSION['oauth_verify']);

        // get the access token
        $reply = $cb->oauth_accessToken(array(
            'oauth_verifier' => $_GET['oauth_verifier']
        ));

        // store the token (which is different from the request token!)
        $_SESSION['oauth_token'] = $reply->oauth_token;
        $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

        // send to same URL, without oauth GET parameters
        header('Location: ' . basename(__FILE__));
        die();
    }

    // assign access token on each page load
    $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    //$reply = $cb->statuses_update('status=Whohoo, I just tweeted!');
    
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    //$reply = $cb->statuses_user_timeline();
    $reply = $cb->statuses_homeTimeline();
    foreach ($reply as $test){
        if(!is_null($test)){            
            //print_r($test);
        } 
        //echo('<p>'.$test->text.'</p>'); 
    }
    //print_r($reply);
   // echo ($reply);
    //$reply = $cb->statuses_update('status=Whohoo, I just tweeted again!');
    ?>