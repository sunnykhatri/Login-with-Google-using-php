<?php
require_once 'config.php';
if(isset($_SESSION['userData'])){
	header('location: view.php');
}
$loginURL="";
$authUrl = $googleClient->createAuthUrl();
$loginURL = filter_var($authUrl, FILTER_SANITIZE_URL);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login & Registration with google using Php </title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<header>
		<div class="head_left">
			<img src="assets/image/logo.png" height="50px"  >
		</div>
	</header>
	<p class="main_title">
		Login & Registration with google using Php 	<br/>
		<a href="http://www.codecastra.com/login-with-google-using-php/"><small>← Back to article</small></a>
	</p>
	<section class="main">
		<div class="inner">
			<div class="img_p">
				<img src="assets/image/lock3.png" class="img"> 
			</div>
			<p class="inner_p">
				Let visitors easily authorize on your website with their Google account and save and utilize their data:)
			</p>
			<a href="<?= htmlspecialchars( $loginURL ); ?>"><img src="assets/image/login-google.png" class="fbbutton" alt="Login With Google"></a>
		</div>
	</section>
	<section class="content content--related">
		<p>If you enjoyed this demo you might also like:</p>
		<a class="media-item" href="http://codecastra.com/login-with-facebook-using-php/">
			<img class="media-item__img" src="assets/related/related_fb.png">
			<h3 class="media-item__title">Login & Registration With  Facebook</h3>
		</a>
		<a class="media-item" href="http://codecastra.com/login-twitter-using-php/">
			<img class="media-item__img" src="assets/related/related_twitter.png">
			<h3 class="media-item__title">Login & Registration With  Twitter</h3>
		</a>
	</section>
</body>
</html>