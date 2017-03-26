<?php
    
    require 'fb_init.php';
    require 'fb_get_data.php';

	$mysqli = new mysqli("localhost", "root", "", "final");
	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
	if(isset($_SESSION['facebook_access_token'])){
		
		$query = "SELECT `fb_id` FROM `admin` WHERE `fb_id` = {$userNode->getId()}";
		$result = $mysqli->query($query);
		$result = $result->fetch_array(MYSQLI_ASSOC);
		$result = $result["fb_id"];
		//$mysqli->close();
		if($userNode->getId() != $result)
			header('Location: ../index.php');
	}else{
        header('Location: ../index.php');
    }
?>