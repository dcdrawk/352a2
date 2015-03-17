<?php
/*
 * login_with_flickr.php
 *
 * @(#) $Id: login_with_flickr.php,v 1.5 2014/10/13 07:42:07 mlemos Exp $
 *
 */

	/*
	 *  Get the http.php file from http://www.phpclasses.org/httpclient
	 */
	require('http.php');
	require('oauth_client.php');

	$client = new oauth_client_class;
	$client->debug = false;
	$client->debug_http = true;
	$client->server = 'Flickr';
	$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].
		dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/login_with_flickr.php';

	$client->client_id = '472ef22e7e2b2c1e1d9218051d7b54ac'; $application_line = __LINE__;
	$client->client_secret = '2d780a5f800f00e9';

	if(strlen($client->client_id) == 0
	|| strlen($client->client_secret) == 0)
		die('Please go to Flickr Apps page http://www.flickr.com/services/apps/create/ , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Key and client_secret with Secret.');

	$client->scope = 'read'; // 'read', 'write' or 'delete'
	if(($success = $client->Initialize()))
	{
		if(($success = $client->Process()))
		{
			if(strlen($client->access_token))
			{
				$success = $client->CallAPI(
					'https://api.flickr.com/services/rest/',
					'GET', array(
						'method'=>'flickr.test.login',
						'format'=>'xmlrpc',
						//'noxmlrpccallback'=>'1'
					), array('FailOnAccessError'=>true), $user);
			}
		}
		$success = $client->Finalize($success);
	}
	if($client->exit)
		exit;
	if($success)
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Flickr OAuth client results</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	//print_r($user, 1));
	$myXMLData = $user;
	$xml = new SimpleXMLElement($myXMLData);

  //$value = (array) $users;
	$test = xml_parser_create();
	//$xml = xml_parse($test,$user);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
	$username = (array)$xml->params->param->value;
	$testName = trim(strip_tags($username['string']));
	print_r($username['string']);
	print_r($user);
	//$test = xmlrpc_decode($user);
	print_r($test);

		echo '<h1>',HtmlSpecialChars($testName),
			' you have logged in successfully with Flickr!</h1>';
		echo '<pre>', print_r($user, 1), '</pre>';

		$userInfo_method = 'flickr.people.findByUsername';



		$userID_link = "https://api.flickr.com/services/rest/?&method=".$userInfo_method."&api_key=".$client->client_id."&username=".$testName;
		$userInfo = simplexml_load_file($userID_link);
		$userArray = (array)$userInfo->user;
		$userID = $userArray['@attributes']['id'];
		//echo '<a href="'.$userID_link.'"> Testing</a>';
		//print_r($userID);

		$userPhotos_method = 'flickr.people.getPhotos';
		$userPhotos_link = "https://api.flickr.com/services/rest/?&method=".$userPhotos_method."&api_key=".$client->client_id."&user_id=".$userID."&per_page=3";
		$userPhotos = simplexml_load_file($userPhotos_link);
		//print_r($userPhotos->photos);

		$getSizes_method = 'flickr.photos.getSizes';

		$threeArray = (array)$userPhotos->photos->photo;
			$firstThree = array_slice($threeArray, 0, 3);
		//print_r($threeArray);
		//print_r($firstThree);
		foreach($userPhotos->photos->photo as $photo){
			$photoSizes_link = "https://api.flickr.com/services/rest/?&method=".$getSizes_method."&api_key=".$client->client_id."&photo_id=".$photo['id'];
			$photoSizes = simplexml_load_file($photoSizes_link);
			$sizeArray = (array)$photoSizes->sizes;
			$newArray = (array)$sizeArray['size'][1];
			$sourceLink = $newArray['@attributes']['source'];
		//	if($photoSizes->sizes)

			//print_r($sizeArray['size']);
			//print_r($newArray['@attributes']['source']);
			//print_r($newArray);


			//print_r($newArray['@attributes']['label']);
			// echo '<a href="https://www.flickr.com/photos/'.$userID.'/'.$photo['id'].'">';
			 echo '<img src="'.$sourceLink.'">';
			// echo '</a>';
			//echo $photo['id'];
			//print_r($photo['id']);
		}
		print_r($_SESSION);
?>
<a href="logout.php" >Logout</a>
</body>
</html>
<?php
	}
	else
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>OAuth client error</title>
</head>
<body>
<h1>OAuth client error</h1>
<p>Error: <?php echo HtmlSpecialChars($client->error); ?></p>
</body>
</html>
<?php
	}

?>
