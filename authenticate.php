<?php 
require_once 'config.php';


if(isset($_GET['code'])){
	$googleClient->authenticate($_GET['code']);
	$_SESSION['token'] = $googleClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}
############ Set Google access token ############
if (isset($_SESSION['token'])) {
	$googleClient->setAccessToken($_SESSION['token']);
}


if ($googleClient->getAccessToken()) {
	############ Fetch data from graph api  ############
	try {
		$gpUserProfile = $google_oauthV2->userinfo->get();
	}
	catch (\Exception $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		header("Location: ./");
		exit;
	}
	############ Store data in database  ############
	$oauthpro = "google";
	$oauthid = $gpUserProfile['id'] ?? '';
	$f_name = $gpUserProfile['given_name'] ?? '';
	$l_name = $gpUserProfile['family_name'];
	$gender = $gpUserProfile['gender'] ??  '';
	$email_id = $gpUserProfile['email'] ?? '';
	$locale = $gpUserProfile['locale'] ?? '';
	$cover = '';
	$picture = $gpUserProfile['picture'] ?? '';
	$url = $gpUserProfile['link'] ?? '';
	$sql = "SELECT * FROM usersdata WHERE oauthid='".$gpUserProfile['id']."'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
	   $conn->query("update usersdata set f_name='".$f_name."', l_name='".$l_name."', email_id='".$email_id."', gender='".$gender."', locale='".$locale."', cover='".$cover."', picture='".$picture."', url='".$url."' where oauthid='".$oauthid."' ");
	} else {
		$conn->query("INSERT INTO usersdata (oauth_pro, oauthid, f_name, l_name, email_id, gender, locale, cover, picture, url) VALUES ('".$oauthpro."', '".$oauthid."', '".$f_name."', '".$l_name."', '".$email_id."', '".$gender."', '".$locale."', '".$cover."', '".$picture."', '".$url."')");  
	}
	$res = $conn->query($sql);
	$userData = $res->fetch_assoc();

	$_SESSION['userData'] = $userData;
	header("Location: view.php");

} else {
	header("Location:/");
}


?>