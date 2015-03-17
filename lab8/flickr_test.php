<?php
//    Flickr API test page
//    Key: 472ef22e7e2b2c1e1d9218051d7b54ac 
//    Secret: 2d780a5f800f00e9

//    Create a login link:
//    http://flickr.com/services/auth/?api_key=[api_key]&perms=[perms]&api_sig=[api_sig]
//    $oauth_signature = base64_encode(hash_hmac('sha1', $baseurl, $hashkey, true));

//
//
    $consumerKey = '472ef22e7e2b2c1e1d9218051d7b54ac';
    $consumerSecret = '2d780a5f800f00e9';
//
//    $requestTokenUrl = "https://www.flickr.com/services/oauth/request_token"; 
//    $oauthTimestamp = time();
//    $nonce = md5(mt_rand()); 
//    $oauthSignatureMethod = "HMAC-SHA1"; 
//    $oauthVersion = "1.0";
//
//
//    $sigBase = "GET&" . rawurlencode($requestTokenUrl) . "&"
//        . rawurlencode("oauth_consumer_key=" . rawurlencode($consumerKey)
//        . "&oauth_nonce=" . rawurlencode($nonce)
//        . "&oauth_signature_method=" . rawurlencode($oauthSignatureMethod)
//        . "&oauth_timestamp=" . $oauthTimestamp
//        . "&oauth_version=" . $oauthVersion);
//
//
//    $sigKey = $consumerSecret . "&"; 
//    $oauthSig = base64_encode(hash_hmac("sha1", $sigBase, $sigKey, true));
//
//    $requestUrl = $requestTokenUrl . "?"
//        . "oauth_consumer_key=" . rawurlencode($consumerKey)
//        . "&oauth_nonce=" . rawurlencode($nonce)
//        . "&oauth_signature_method=" . rawurlencode($oauthSignatureMethod)
//        . "&oauth_timestamp=" . rawurlencode($oauthTimestamp)
//        . "&oauth_version=" . rawurlencode($oauthVersion)
//        . "&oauth_signature=" . rawurlencode($oauthSig); 
//
//    //$response = file_get_contents($requestUrl);
//    echo($requestUrl);
//    //var_export($response);
//
//var hash = MD5(2d780a5f800f00e9 + "api_key" + 472ef22e7e2b2c1e1d9218051d7b54ac  + "auth_token" + token + "submitUpload");
//
////    echo('<a href="'.$requestUrl.'">
////    Login to Flickr </a>');
//    echo('<a href="http://flickr.com/services/auth/?api_key=472ef22e7e2b2c1e1d9218051d7b54ac&perms=read&api_sig='.$oauthSig.'">
//    Login to Flickr </a>');
//
    echo('<a href="https://api.flickr.com/services/rest/?&method=flickr.people.getPublicPhotos&api_key=472ef22e7e2b2c1e1d9218051d7b54ac&user_id=131075525@N02">
    testing</a>');

    $methodGetFrob = "flickr.auth.getFrob";
    //echo $methodGetFrob;

  //$sig = $consumerSecret."api_key".$consumerKey."method".$methodGetFrob;
    $sig = $consumerSecret."api_key".$consumerKey."permswrite";
    $signature = MD5($sig);

    $request = "https://api.flickr.com/services/rest/?method=".$methodGetFrob."&api_key=".$consumerKey."&api_sig=".$signature;
    //$login = "http://www.flickr.com/services/auth/?api_key=".$consumerKey."&perms=read&frob=.$methodGetFrob.&api_sig=".$signature;
    $login = "http://www.flickr.com/services/auth/?api_key=".$consumerKey."&perms=write&api_sig=".$signature;
  //System.out.println("GET frob request: " + request);
//    echo($request);
    echo('<a href="'.$login.'">
   Login to Flickr </a>');

        $method = 'flickr.auth.getToken';
   

    //$response = file_get_contents($testMethod);
    
    $getPhotos = simplexml_load_file('https://api.flickr.com/services/rest/?&method=flickr.photos.getRecent&api_key=472ef22e7e2b2c1e1d9218051d7b54ac');
    //$getPhotos = 'https://api.flickr.com/services/rest/?&method=flickr.photos.getRecent&api_key=472ef22e7e2b2c1e1d9218051d7b54ac';
    //echo $getPhotos;

    $value = (array) $getPhotos->photos->photo;
    print_r($value['@attributes']['owner']);
    //print_r($getPhotos);
    //$console.log($response);
    //echo('<a href="'.$getPhotos.'">Photo test</a>');
    //echo('<a href="'.$login.'"> Login to Flickr </a>');

    //rstream = method.getResponseBodyAsStream();
    


    if(isset($_GET['frob'])){
        $frob = $_GET["frob"];
        echo 'frob is set!';
        $testMethod = simplexml_load_file("https://api.flickr.com/services/rest/?&method=".$method."&api_key=".$consumerKey."&api_sig=".$signature."&frob=".$frob);
        print_r($testMethod);
    }
?> 
<!--
<a href="http://flickr.com/services/auth/?api_key=472ef22e7e2b2c1e1d9218051d7b54ac&perms=read&api_sig=2d780a5f800f00e9">
    Login to Flickr
</a>
-->
<!--
<a href="http://flickr.com/services/auth/?api_key=472ef22e7e2b2c1e1d9218051d7b54ac&perms=write&api_sig=2d780a5f800f00e9">
    Login to Flickr
</a>-->
