<?php
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $response["uid"] = $session['uid'];
    $response["email"] = $session['email'];
    $response["name"] = $session['name'];
    echoResponse(200, $response);
});

$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('username', 'password'),$r->userName);
    $response = array();
    $db = new DbHandler();
    $username = $r->userName->username;
    $password = $r->userName->password;
    //$email = $r->userName->email;
    $user = $db->getOneRecord("select uid,username,password,email,created from users where username='$username'");
    if ($user != NULL) {
        if(passwordHash::check_password($user['password'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['username'] = $user['username'];
        $response['uid'] = $user['uid'];
        $response['email'] = $user['email'];
        $response['createdAt'] = $user['created'];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    }else {
            $response['status'] = "error";
            $response['message'] = 'No such user is registered';
        }
    echoResponse(200, $response);
});
$app->post('/signUp', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'username', 'password'),$r->userName);
    require_once 'passwordHash.php';
    $db = new DbHandler();
    // $phone = $r->customer->phone;
    $username = $r->userName->username;
    $email = $r->userName->email;
    //$address = $r->userName->address;
    $password = $r->userName->password;
    $isUserExists = $db->getOneRecord("select 1 from users where username='$username' or email='$email'");
    if(!$isUserExists){
        $r->userName->password = passwordHash::hash($password);
        $tabble_name = "users";
        $column_names = array('username', 'email', 'password');
        $result = $db->insertIntoTable($r->userName, $column_names, $tabble_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $response["uid"];
            //$_SESSION['phone'] = $phone;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create user. Please try again";
            echoResponse(201, $response);
        }
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided username or email already exists!";
        echoResponse(201, $response);
    }
});
$app->get('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});
$app->post('/postMessage', function() use ($app) {
  $r = json_decode($app->request->getBody());
  $db = new DbHandler();
  verifyRequiredParams(array('uid', 'message'),$r->userName);
  $tabble_name = "messages";
  $column_names = array('uid', 'message');
  $result = $db->insertIntoTable($r->userName, $column_names, $tabble_name);
  if ($result != NULL) {
    $response["status"] = "success";
    $response["message"] = "Your message has been posted";
    echoResponse(200, $response);
  } else {
    $response["status"] = "success";
    $response["message"] = "Your message has been posted";
    echoResponse(200, $response);
  }
});

$app->get('/messages', function() use ($app) {
    $db = new DbHandler();
    $session = $db->getSession();
    $uid = $session['uid'];
    $result = $db->getRecords("select * from messages where uid='$uid'");
    $response["message"] = $result;
    echoResponse(200, $response);
});
?>
