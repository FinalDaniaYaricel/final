<?php

	session_start();
	require '../fb_init.php';
	require '../fb_get_data.php';
	
	$helper = $fb->getRedirectLoginHelper();
	$permissions = [];
	$loginUrl = $helper->getLoginUrl('https://proyectoweb032017.ddns.net/admin/callback.php', $permissions);
	//$loginUrl = $helper->getLoginUrl('http://final-proyectoweb032017304221.codeanyapp.com/admin/callback.php', $permissions);
	//$loginUrl = $helper->getLoginUrl('http://localhost/final/admin/callback.php', $permissions);
	if(isset($_POST['admin'])){
		if($_POST["admin"] == "Si, si lo soy"){
			header('Location: '.$loginUrl);
		}
		else{
			echo "
				<script>
					alert('No, creo que no eres admin. Adios ;)');
					window.location = '../index.php';
				</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<body onload="myFunction()">

<script>
function myFunction() {
    var admin = prompt("Eres admin si o no?", "");
    if (admin != null && admin != "") {
		document.getElementById("admin").value = admin;
		document.getElementById("form").submit();
    }else{
		alert('No, creo que no eres admin. Adios ;)');
		window.location = "../index.php";
	}
}
</script>

<form id="form" method="post">
    <input type="hidden" id="admin" name="admin" />
</form>

</body>
</html>