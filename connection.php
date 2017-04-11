<?php

	$mysqli = new mysqli("localhost", "root", "", "final");
	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
	
?>