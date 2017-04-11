<?php
	
	require 'facebook-sdk/autoload.php';
	
	$fb = new Facebook\Facebook([
		'app_id' => '296589014093534', // Replace {app-id} with your app id
		//'app_id' => '190433688117642', // Replace {app-id} with your app id
		'app_secret' => 'edf254c12a23ce46dbde5087d57de82c',
		//'app_secret' => '64843113b1368c5ea3a46b8558369eb6',
		'default_graph_version' => 'v2.8',
	]);
	
?>