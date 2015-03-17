<?php
/* Last updated with phpFlickr 1.3.2
 *
 * This example file shows you how to call the 100 most recent public
 * photos.  It parses through them and prints out a link to each of them
 * along with the owner's name.
 *
 * Most of the processing time in this file comes from the 100 calls to
 * flickr.people.getInfo.  Enabling caching will help a whole lot with
 * this as there are many people who post multiple photos at once.
 *
 * Obviously, you'll want to replace the "<api key>" with one provided 
 * by Flickr: http://www.flickr.com/services/api/key.gne
 */
//session_start();
require_once("phpFlickr.php");

//$client = new HttpClient();

//$method = new GetMethod(request);
//
//    $rstream = $method.getResponseBodyAsStream();

    //$frobResponse = response.getElementsByTagName("frob");

  //$frobNode = frobResponse.item(0);

    $f = new phpFlickr("472ef22e7e2b2c1e1d9218051d7b54ac", "2d780a5f800f00e9");
if(!isset($_SESSION['phpFlickr_auth_token'])){
    //echo $_GET["frob"];
    $frob = $_GET["frob"];
    $authToken = $f->auth_getToken($frob);
    //$f->setToken($authToken);
    
    //$recent = $f->photos_getRecent();
    //echo $_SESSION['phpFlickr_auth_token']['_content'];
    //print_r($_SESSION);
    //print_r($token);
        $test = $f->test_login();
    echo $test;
    echo 'its not set!';
} else {
    echo 'its set!';
    print_r($_SESSION);
    //$f->sync_upload("photo.jpg");

    //print_r($test);
}

?>