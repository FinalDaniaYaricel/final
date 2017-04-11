<?php

	
session_start();
require 'fb_init.php';

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

    require 'fb_get_data.php';
	include 'connection.php';
	
	if(isset($_SESSION['facebook_access_token'])){
		
		$query = "SELECT `fb_id` FROM `user` WHERE `fb_id` = {$userNode->getId()}";
		$result = $mysqli->query($query);
		$result = $result->fetch_array(MYSQLI_ASSOC);
		$result = $result["fb_id"];
		
		if($userNode->getId() != $result){
			$date = date("Y,m,d");
			$query = "INSERT INTO `user`(`fb_id`,`fb_name`,`fb_picture`,`fb_link`,`date`) VALUES ({$userNode->getId()}, '{$userNode->getName()}', '{$userNode->getPicture()->getUrl()}', '{$userNode->getLink()}', '{$date}')";
			$mysqli->query($query);
		}else{
			$query = "UPDATE `user` SET `fb_name`='{$userNode->getName()}', `fb_picture`='{$userNode->getPicture()->getUrl()}', `fb_link`='{$userNode->getLink()}' WHERE `fb_id` = {$userNode->getId()}";
			$mysqli->query($query);
		}
		
		$mysqli->close();
	}
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
  header('Location: index.php');
}

?>