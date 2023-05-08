<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . "/connectDB.php";

session_start();

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

// init configuration
$clientID = '1023302539404-ndteplpbqobuatfulkan6put430uh7l4.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:8012/web2-new--main/web2-new--main/index.php?number=login';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  try {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  } catch (Exception $e) {
    echo "Failed to retrieve access token: " . $e->getMessage();
    die();
  }

  if (isset($token['access_token'])) {
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $userinfo = [
      'email' => $google_account_info['email'],
      'FirstName' => $google_account_info['givenName'],
      'LastName' => $google_account_info['familyName'],
      'Gender' => $google_account_info['gender'],
      'Fullname' => $google_account_info['name'],
      'picture' => $google_account_info['picture'],
      'verifiedEmail' => $google_account_info['verifiedEmail'],
      'token' => $google_account_info['id'],
    ];
    // checking if user is already exists in database
    $sql = "SELECT * FROM googleuser WHERE email ='{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // user is exists
      $userinfo = mysqli_fetch_assoc($result);
      $token = $userinfo['token'];

      // update user information
      $sql = "UPDATE googleuser SET FirstName='{$userinfo['FirstName']}', LastName='{$userinfo['LastName']}', Gender='{$userinfo['Gender']}', Fullname='{$userinfo['Fullname']}', picture='{$userinfo['picture']}', verifiedEmail='{$userinfo['verifiedEmail']}' WHERE email='{$userinfo['email']}'";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        echo "Failed to update user information";
        die();
      }
    } else {
      // user is not exists
      $sql = "INSERT INTO googleuser (email, FirstName, LastName, Gender, Fullname, picture, verifiedEmail, token) VALUES ('{$userinfo['email']}', '{$userinfo['FirstName']}', '{$userinfo['LastName']}', '{$userinfo['Gender']}', '{$userinfo['Fullname']}', '{$userinfo['picture']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $token = $userinfo['token'];
      } else {
        echo "User is not created";
        die();
      }
    }

    // save user data into session
    $_SESSION['user_token'] = $token;
    $_SESSION['userinfo'] = $userinfo;

    // redirect to showAccount.php
    header("Location: index.php");
    exit();

  } else {
    if (!isset($_SESSION['user_token'])) {
      echo`header("Location: index.php")`;
      die();
    }

    // checking if user is already exists in database
    $sql = "SELECT * FROM googleuser WHERE token ='{$_SESSION['user_token']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // user is exists
      $userinfo = mysqli_fetch_assoc($result);
    }
  }
}
