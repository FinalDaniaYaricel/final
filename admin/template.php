<?php
	
$obj = new MyDestructableClass();

class MyDestructableClass {
	function __construct() {
		$classInicio = $classCategorias = $classAnuncios = $classUsuarios = $classEstadisticas = "";
		if (strpos($_SERVER['REQUEST_URI'], 'final/admin/index.php') !== false)
			$classInicio = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/admin/category.php') !== false)
			$classCategorias = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/admin/advert.php') !== false)
			$classAnuncios = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/admin/user.php') !== false)
			$classUsuarios = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/admin/statistics.php') !== false)
			$classEstadisticas = "active";
		
		session_start();
		require '../fb_init.php';
		require '../fb_get_data.php';
		
		if (strpos($_SERVER['REQUEST_URI'], 'final/admin/login.php') == false)
			include 'user_valid.php';
?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Page of Manager</title>
				<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
				<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
				<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
				<script type="text/javascript"></script>
				<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
				<link href="style.css" rel="stylesheet">
				<?php //if (strpos($_SERVER['REQUEST_URI'], 'final/admin/statistics.php') !== false){ echo '<script src="https://code.highcharts.com/highcharts.src.js"></script>'; } ?>
				<?php if (strpos($_SERVER['REQUEST_URI'], 'admin/statistics.php') !== false){ echo '<script src="https://code.highcharts.com/highcharts.src.js"></script>'; } ?>
			</head>
			<body <?php if (strpos($_SERVER['REQUEST_URI'], 'final/admin/login.php') !== false){ echo 'onload="myFunction()"'; } ?> >
				<nav class="navbar navbar-default navbar-inverse" role="navigation">
					<div class="container-fluid">
						<button id="btn_collapse" type="button" class="btn" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
						</button>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="<?php echo $classInicio; ?>"><a href="../index.php">Inicio</a></li>
								<li class="<?php echo $classAnuncios; ?>"><a href="advert.php">Anuncios</a></li>
								<li class="<?php echo $classCategorias; ?>"><a href="category.php">Categorias</a></li>
								<li class="<?php echo $classUsuarios; ?>"><a href="user.php">Usuarios</a></li>
								<li class="<?php echo $classEstadisticas; ?>"><a href="statistics.php">Estadisticas</a></li>
								<?php if(isset($_SESSION['facebook_access_token'])){ ?><li class=""><a target="_blank" href=" <?php echo $userNode->getLink(); ?>">Mi Cuenta</a></li> <?php } ?>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<?php 
									if(isset($_SESSION['facebook_access_token'])){
										echo '<li><p class="navbar-text">Logged in as ' . $userNode->getName() . '</p></li>';
										echo '<li><a class="btn btn-default" href="logout.php">Logout</a></li>';
									}
								?>
							</ul>
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



