<?php

session_start();
##### DB Configuration #####
$servername = "localhost";
$username = "YourDBUsername";
$password = "YourDBPassword";
$db = "db_oauth";

##### Google App Configuration #####
$googleappid = "YourGoogleAppID"; 
$googleappsecret = "YourGoogleAppSecret"; 
// $redirectURL = "http://localhost:81/LoginwithGoogle/authenticate.php"; 
$redirectURL = "YourRedirectURL"; 

##### Create connection #####
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
##### Required Library #####
include_once 'src/Google/Google_Client.php';
include_once 'src/Google/contrib/Google_Oauth2Service.php';

$googleClient = new Google_Client();
$googleClient->setApplicationName('Login to CodeCastra.com');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($googleClient);

?>