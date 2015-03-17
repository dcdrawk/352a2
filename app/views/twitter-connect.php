<div id="pageTitle" class="titleBar" layout="row">
  <h2>Twitter</h2>
</div>
<!--Codebird twitter code-->
<?php
    require_once('../api/config.php');
    require_once('../api/v1/dbConnect.php');
    require_once('../api/libs/codebird/codebird.php');
    require_once('../api/libs/codebird/twitter_config.php');
    \Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();

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
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    //$isUserExists = $db->getOneRecord("select 1 from users where username='$username' or email='$email'");
    $userQuery = "SELECT 1 FROM twitter WHERE uid='".$_SESSION['uid']."'";
    $checkUser = $db->query($userQuery)->fetch_assoc();
    //$query = "INSERT INTO twitter (uid) VALUES ('22')";
        //$result = $db->query($query);
    print_r($checkUser);
    if(!$checkUser){
        echo 'user doesnt exists!';
        //print_r($checkUser);
        $query = "INSERT INTO twitter (uid, twitter_token, twitter_secret) VALUES ('".$_SESSION['uid']."', '".$_SESSION['oauth_token']."', '".$_SESSION['oauth_token_secret']."')";
        $result = $db->query($query);
        echo $query;
         //print_r($result);
    } else {
        echo 'user exists!';
    }

    //Get the difference in time
    $now = time();
    $lastUpdated = "SELECT timestamp FROM twitter WHERE uid='".$_SESSION['uid']."'";
    $updateTime = $db->query($lastUpdated)->fetch_assoc();
    //print_r($updateTime['timestamp']);
    
    $updated = strtotime($updateTime['timestamp']);
    $diff = $now-$updated;
    print_r($diff);
    //if 5 minutes has passed
    if($diff > 10){
        //Get the 5 latest tweets from this user's account
        $params['count'] = 5;
        $combined ='';
        $userTimeline = (array)$cb->statuses_userTimeline($params);
        print_r($userTimeline);
        //$timelineString = (string)$userTimeline;
        foreach ($userTimeline as $tweet){
            if(isset($tweet->text)){            
                $combined .= $tweet->text.',';
                //print_r($tweet->text);
                //$formated = formatTweet($tweet->text);
                //echo '<p>'.$formated.' Time:'.time().'</p>';
                //echo 'not null ';
            } 
            //print_r($tweet->text);
            //echo '<p>'.$tweet.'</p>';
        }            
        $updateTweets = "UPDATE twitter SET recent_tweets = '".$combined."', timestamp=NOW()";
        $insertTweets = $db->query($updateTweets);
    }

    $queryCachedTweets ="SELECT recent_tweets FROM twitter WHERE uid='".$_SESSION['uid']."'";
    $getCachedTweets = $db->query($queryCachedTweets)->fetch_assoc();
    //$tweetList = explode(",", $getCachedTweets);
    //$testString = implode($getCachedTweets);
    $tweetList = explode(",", implode($getCachedTweets));
    //print_r($tweetList);
    foreach($tweetList as $tweet){
        $formated = formatTweet($tweet);
        echo '<p>'.$formated.' Time:'.time().'</p>';
        //echo 'not null ';
    }
//$query = "UPDATE users SET twitter_token = '".$_SESSION['oauth_token']."', twitter_secret = '".$_SESSION['oauth_token_secret']."' WHERE uid='"





    //$reply = $cb->statuses_update('status=testing out the formatting #schoolproject!');
    //$reply = $cb->fetch_feed();

    //print_r($userTimeline[1]->text);

    function formatTweet($str){

        // Linkifying URLs, mentionds and topics. Notice that
        // each resultant anchor type has a unique class name.

        $str = preg_replace(
            '/((ftp|https?):\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/i',
            '<a class="link" href="$1" target="_blank">$1</a>',
            $str
        );

        $str = preg_replace(
            '/(\s|^)@([\w\-]+)/',
            '$1<a class="mention" href="http://twitter.com/#!/$2" target="_blank">@$2</a>',
            $str
        );

        $str = preg_replace(
            '/(\s|^)#([\w\-]+)/',
            '$1<a class="hash" href="http://twitter.com/search?q=%23$2" target="_blank">#$2</a>',
            $str
        );

        return $str;
    }

    
//echo ($reply);
?>

<md-content class="md-padding" md-theme="default">
  <section layout="row" layout-sm="column" layout-align="center center">
      
  </section>
</md-content>
