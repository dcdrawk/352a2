<?php

//get the session info
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $response["uid"] = $session['uid'];
    $response["email"] = $session['email'];
    $response["experience"] = $session['experience'];
    $response["name"] = $session['name'];
    echoResponse(200, $response);
});

//get the email of a user
$app->get('/email', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $uid = $session['uid'];
    $user = $db->getOneRecord("select email from users where uid='$uid'");
    $response["email"] = $user;
    echoResponse(200, $response);
});

//login function, checks database for username / password
$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    //verifies the required parameters are present
    verifyRequiredParams(array('username', 'password'),$r->userName);
    //create a new response as an array
    $response = array();
    $db = new DbHandler();
    $username = $r->userName->username;
    $password = $r->userName->password;
    //gets the records matching the username
    $user = $db->getOneRecord("select uid,username,password,email,experience,created from users where username='$username'");
    if ($user != NULL) {
        //checks the password
        if(passwordHash::check_password($user['password'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['username'] = $user['username'];
        $response['uid'] = $user['uid'];
        $response['email'] = $user['email'];
        $response['experience'] = $user['experience'];
        $response['createdAt'] = $user['created'];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['experience'] = $user['experience'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
      }else{
          //error message if things don't go well
          $response['status'] = "error";
          $response['message'] = 'No such user is registered';
      }
    echoResponse(200, $response);
});
$app->post('/signUp', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'username', 'password', 'experience'),$r->userName);
    require_once 'passwordHash.php';
    $db = new DbHandler();
    // $phone = $r->customer->phone;
    $username = $r->userName->username;
    $email = $r->userName->email;
    //$address = $r->userName->address;
    $password = $r->userName->password;
    $experience = $r->userName->experience;
    $isUserExists = $db->getOneRecord("select 1 from users where username='$username' or email='$email'");
    if(!$isUserExists){
        $r->userName->password = passwordHash::hash($password);
        $tabble_name = "users";
        $column_names = array('username', 'email', 'password', 'experience');
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
            $_SESSION['experience'] = $experience;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create user. Please try again";
            echoResponse(201, $response);
        }
    }else{
        $response["status"] = "error";
        $response["message"] = "A user with the provided username or email already exists!";
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
  verifyRequiredParams(array("uid", "title", "message", "created"),$r->userName);
  $r->userName->title = mysql_real_escape_string($r->userName->title);
  $r->userName->message = mysql_real_escape_string($r->userName->message);
  $tabble_name = "messages";
  $column_names = array("uid", "title", "message", "created");
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

$app->post('/memberMessages', function() use ($app) {
  $response = array();
  $r = json_decode($app->request->getBody());
  $db = new DbHandler();
  $uid = $r->uid;
  $result = $db->getRecords("select * from messages where uid='$uid'");
  $response["message"] = $result;
  echoResponse(200, $response);
});

$app->get('/members', function() use ($app) {
    $db = new DbHandler();
    $session = $db->getSession();
    $uid = $session['uid'];
    $result = $db->getRecords("select uid,username,email,experience from users");
    $response["message"] = $result;
    echoResponse(200, $response);
});

$app->post('/updateEmail', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    $db = new DbHandler();
    $session = $db->getSession();
    $uid = $session['uid'];
    verifyRequiredParams(array('email'),$r->userName);
    $email = mysql_real_escape_string($r->userName->email);
    $isEmailExists = $db->getOneRecord("select 1 from users where email='$email'");
    if(!$isEmailExists){
    $table_name = "users";
    $column_name = 'email';
    $_SESSION['email'] = $r->userName->email;
    $result = $db->updateTable($table_name, $column_name, $email, $uid);
      if ($result = NULL) {
        $response["status"] = "success";
        $response["message"] = "Your Email has been updated";
        echoResponse(200, $response);
      } else {
        $response["status"] = "success";
        $response["message"] = "Your Email has been updated";
        echoResponse(200, $response);
      }
    } else {
      $response["status"] = "error";
      $response["message"] = "A user with the provided username or email already exists!";
      echoResponse(201, $response);
    }

});
?>
