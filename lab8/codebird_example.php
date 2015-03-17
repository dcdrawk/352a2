<?php
/**
 * Database configuration
 */
define('DB_USERNAME', 'djc6');
define('DB_PASSWORD', 'djc6');
define('DB_HOST', 'localhost');
// define('DB_NAME', 'angularcode');
define('DB_NAME', 'djc6');

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
?>

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
    //$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

  //  echo ('WUT');
//$query    = 'SELECT email FROM users WHERE uid = 1';
//$query = "UPDATE ".$table_name." SET ".$column_name."= '$value' WHERE uid='$uid'";
$query = "UPDATE users SET twitter_token = '".$_SESSION['oauth_token']."', twitter_secret = '".$_SESSION['oauth_token_secret']."' WHERE uid='1'";
//$query = "UPDATE users SET twitter_token = ".$_SESSION['oauth_token']." AND SET twitter_secret = ".$_SESSION['oauth_token_secret']." WHERE uid='1'";
$result = $db->query($query);

//$test = $result->fetch_assoc();
//echo implode($test);
//if (!$result) {
//    throw new Exception("Database Error [{$db->database->errno}] {$db->database->error}");
//}

if(isset($_SESSION['oauth_token']) && isset($_SESSION['oauth_token_secret'])){
	echo('you are signed into twitter!');
}
$query2 = 'SELECT twitter_token, twitter_secret FROM users WHERE uid = 1';
$result2 = $db->query($query2);
$twitter_keys = $result2->fetch_assoc();

echo ($twitter_keys['twitter_token']);
$cb->setToken($twitter_keys['twitter_token'], $twitter_keys['twitter_secret']);
$reply = $cb->statuses_update('status=I just tweeted through my DB again!');


?>