<?php

include 'template.php';

$dir_name = "uploads";

if (!file_exists($dir_name))
mkdir($dir_name, 0700);

require 'fb_init.php';
require 'fb_get_data.php';
require 'connection.php';

$total1 = 0;
$date = date("Y,m,d");
$name_files_uploads = '';
$total = count($_FILES["fileToUpload"]["name"]);
for($i=0; $i<$total; $i++) {
	if($_FILES["fileToUpload"]["name"][$i] !== ""){
		$total1 = ($i+1);
	}
}
for($i=0; $i<$total1; $i++) {
	if($_FILES["fileToUpload"]["name"][$i] !== ""){
		$target_dir = $dir_name."/";
		$target_file = $target_dir . $userNode->getId() . rand() . rand() . rand() . basename($_FILES["fileToUpload"]["name"][$i]);
		if($i < ($total1-1)){
			$name_files_uploads .= $target_file.',';
		}else{
			$name_files_uploads .= $target_file;
		}
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
			
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"][$i]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
}

if(isset($_SESSION['facebook_access_token'])){
		if($_POST && $_POST['id'] == 0){
			$query = "INSERT INTO `anuncio`(`fb_id`, `cat_id`, `title`, `body`, `image`, `date`) VALUES ({$userNode->getId()},{$_POST['category']},'{$_POST['title']}','{$_POST['body']}','{$name_files_uploads}','{$date}')";
			$mysqli->query($query);
		}else{
			$query = "SELECT `image` FROM `anuncio` WHERE `id`={$_POST['id']}";
			$result = $mysqli->query($query);
			while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
				if($name_files_uploads == "")
					$name_files_uploads = $result1["image"];
			}
			$query = "UPDATE `anuncio` SET `cat_id`={$_POST['category']}, `title`='{$_POST['title']}', `body`='{$_POST['body']}', `image`='{$name_files_uploads}' WHERE `id`={$_POST['id']}";
			$mysqli->query($query);
		}
		header('Location: index.php');
}
?>