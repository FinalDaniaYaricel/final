<?php
	
$obj = new MyDestructableClass();

class MyDestructableClass {
	function __construct() {
		$classInicio = $classCategorias = $classNosotros = "";
		if (strpos($_SERVER['REQUEST_URI'], 'final/index.php') !== false)
			$classInicio = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/category.php') !== false)
			$classCategorias = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/about_us.php') !== false)
			$classNosotros = "active";
		
	
		session_start();
		require 'fb_init.php';
		require 'fb_get_data.php';
		
?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Page Title</title>
				<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
				<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
				<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
				<script type="text/javascript"></script>
				<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
				<link href="style.css" rel="stylesheet">
			</head>
			<body>
				<nav class="navbar navbar-default navbar-inverse" role="navigation">
					<div class="container-fluid">
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="<?php echo $classInicio; ?>"><a href="index.php">Inicio</a></li>
								<li class="<?php echo $classCategorias; ?> dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorías <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="category.php?cat-1">Categoría 1</a></li>
										<li><a href="category.php?cat-2">Categoría 2</a></li>
										<li><a href="category.php?cat-3">Categoría 3</a></li>
										<li class="divider"></li>
										<li><a href="category.php?cat-4">Categoría 4</a></li>
									</ul>
								</li>
								<?php if(isset($_SESSION['facebook_access_token'])){ ?><li class=""><a target="_blank" href=" <?php echo $userNode->getLink(); ?>">Mi Cuenta</a></li> <?php } ?>
								<li class="<?php echo $classNosotros; ?>"><a href="about_us.php">Nosotros</a></li>
								<?php
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
										$mysqli->close();
										if($userNode->getId() == $result)
										echo '<li class=""><a href="admin/index.php">Admin Menu</a></li>';
									}
								?>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<?php 
									if(isset($_SESSION['facebook_access_token'])){
										echo '<li><p class="navbar-text">Logged in as ' . $userNode->getName() . '</p></li>';
										echo '<li><a class="btn btn-default" href="logout.php">Logout</a></li>';
									}
									else{
										$helper = $fb->getRedirectLoginHelper();
										$permissions = [];
										$loginUrl = $helper->getLoginUrl('http://localhost/final/callback.php', $permissions);
										echo '<li><p class="navbar-text">Login with </p></li>';
										echo '<li><a href="'.$loginUrl.'" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a></li>';
									} 
								?>
							</ul>
							<form class="navbar-form navbar-right" role="search">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Search">
								</div>
								<button type="submit" class="btn btn-default">Submit</button>
							</form>
						</div>
					</div>
				</nav>
<?php
	}
	function __destruct() {
?>
			</body>
		</html>
<?php
	}
}
?>



