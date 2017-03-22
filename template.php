<?php
	
$obj = new MyDestructableClass();

class MyDestructableClass {
	function __construct() {
		if (strpos($_SERVER['REQUEST_URI'], 'final/index.php') !== false)
			$classInicio = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/category.php') !== false)
			$classCategorias = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/my_account.php') !== false)
			$classCuenta = "active";
		if (strpos($_SERVER['REQUEST_URI'], 'final/about_us.php') !== false)
			$classNosotros = "active";
		
		require 'fb_init.php';
		if(isset($_SESSION['facebook_access_token'])){
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			try {
				$response = $fb->get('/me?fields=id,first_name,last_name,name,link,picture');
				$userNode = $response->getGraphUser();
			}
			catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			}
			catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
		}
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
								<li class="<?php echo $classInicio; ?>"><a href="/final/index.php">Inicio</a></li>
								<li class="<?php echo $classCategorias; ?> dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorías <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="/final/category.php?cat-1">Categoría 1</a></li>
										<li><a href="/final/category.php?cat-2">Categoría 2</a></li>
										<li><a href="/final/category.php?cat-3">Categoría 3</a></li>
										<li class="divider"></li>
										<li><a href="/final/category.php?cat-4">Categoría 4</a></li>
									</ul>
								</li>
								<?php if(isset($_SESSION['facebook_access_token'])){ ?><li class="<?php echo $classCuenta; ?>"><a target="_blank" href=" <?php echo $userNode->getLink(); ?>">Mi Cuenta</a></li> <?php } ?>
								<li class="<?php echo $classNosotros; ?>"><a href="/final/about_us.php">Nosotros</a></li>
							</ul>
							<form class="navbar-form navbar-left" role="search">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Search">
								</div>
								<button type="submit" class="btn btn-default">Submit</button>
							</form>
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
										echo '<li><a href="'.$loginUrl.'" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a></li>';
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



