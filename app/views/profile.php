<?php
    require_once('../api/config.php');
    require_once('../api/v1/dbConnect.php');
    require_once('../api/libs/codebird/codebird.php');
    require_once('../api/libs/codebird/twitter_config.php');
    \Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    //formating function found from http://tutorialzine.com/2011/08/display-favorite-tweets-php-css/
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
//    if (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
//            print_r('testing');
//            // verify the token
//            $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
//            unset($_SESSION['oauth_verify']);
//
//            // get the access token
//            $reply = $cb->oauth_accessToken(array(
//                'oauth_verifier' => $_GET['oauth_verifier']
//            ));
//
//            // store the token (which is different from the request token!)
//            $_SESSION['oauth_token'] = $reply->oauth_token;
//            $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
//
//            // send to same URL, without oauth GET parameters
//            header('Location: ' . basename(__FILE__));
//            die();
//        }

?>
<!-- page title -->
<div id="pageTitle" class="titleBar" layout="row">
  <h2>{{name}}'s Profile</h2>
</div>

<!-- Profile info -->
<section id="profileInfo" class="md-padding">
  <div ng-controller="AppCtrl">
    <form id="profileInfo" name="profileInfo">
      <p>User ID - <strong>{{uid}}</strong></p>
      <!-- hide original email while editing -->
      <div ng-class="{'hide' : editingEmail == true}">
        <md-input-container layout="row" ng-class="{'hide' : editingEmail == true}" flex="100">
          <p>Email - <strong>{{myEmail}}</strong>
            <md-button class="editBtn md-raised" type="submit" ng-click="editEmail()"><span>Edit</span></md-button>
          </p>
        </md-input-container>
      </div>
      <md-input-container layout="row" ng-class="{'hide' : editingEmail == false}" flex="100">
        <p>Email -
          <input class="editInput"  placeholder="{{email}}" type="email" name="email" ng-model="newEmail.email"  ng-pattern="/^[a-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+.[a-z0-9-]/" autocomplete="off">
          <md-button class="editBtn md-raised md-primary" ng-click="confirmEmail(newEmail)"><span>Confirm</span></md-button>
          <md-button class="editBtn md-raised" ng-click="cancel()"><span>Cancel</span></md-button>
        </p>
      </md-input-container>

      <p>User experience - <strong>{{userExperience}}</strong></p>
    </form>
  </div>
    
    <?php
        session_start();
        // assign access token on each page load
        $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        print_r($_SESSION['uid']);
    print_r($_SESSION['oauth_token']);
        $userQuery = "SELECT 1 FROM twitter WHERE uid='".$_SESSION['uid']."'";
        $checkUser = $db->query($userQuery)->fetch_assoc();
        if($checkUser){
            echo '<p>Your twitter account is connected!</p>';
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
        if($diff > 50){
            //Get the 5 latest tweets from this user's account
            $params['count'] = 5;
            $combined ='';
            $userTimeline = (array)$cb->statuses_userTimeline($params);
            print_r($userTimeline);
            //$timelineString = (string)$userTimeline;
//            foreach ($userTimeline as $tweet){
//                if(isset($tweet->text)){            
//                    $combined .= $tweet->text.',';
//                    //print_r($tweet->text);
//                    //$formated = formatTweet($tweet->text);
//                    //echo '<p>'.$formated.' Time:'.time().'</p>';
//                    //echo 'not null ';
//                } 
//                //print_r($tweet->text);
//                //echo '<p>'.$tweet.'</p>';
//            }            
//            $updateTweets = "UPDATE twitter SET recent_tweets = '".$combined."', timestamp=NOW()";
//            $insertTweets = $db->query($updateTweets);
        }
        
        echo '<h3>Your Recent Tweets</h3>';
        $queryCachedTweets ="SELECT recent_tweets FROM twitter WHERE uid='".$_SESSION['uid']."'";
        $getCachedTweets = $db->query($queryCachedTweets)->fetch_assoc();
        //$tweetList = explode(",", $getCachedTweets);
        //$testString = implode($getCachedTweets);
        $tweetList = explode(",", implode($getCachedTweets));
        //print_r($tweetList);
        foreach($tweetList as $tweet){
            if($tweet !== ''){
                $formated = formatTweet($tweet);
                echo '<p>'.$formated.'</p>';
            }
        }
    ?>

  <md-button class="md-raised md-primary" type="submit" ng-click="go('adventure-log')" flex="50"><span>View Adventure Log</span></md-button>
    
  <md-button class="md-raised md-primary" type="submit" ng-click="go('twitter-connect')" flex="50"><span>Connect Twitter Account</span></md-button>
</section>
