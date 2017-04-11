<?php

	include "../connection.php";
	
	if(isset($_SESSION['facebook_access_token'])){
		
		$query = "SELECT `fb_id` FROM `admin` WHERE `fb_id` = {$userNode->getId()}";
		$result = $mysqli->query($query);
		$result = $result->fetch_array(MYSQLI_ASSOC);
		$result = $result["fb_id"];
		//$mysqli->close();
		if($userNode->getId() != $result)
			header('Location: ../index.php');
	}else{
        header('Location: login.php');
    }
?>