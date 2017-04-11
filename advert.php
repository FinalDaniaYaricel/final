<link rel="stylesheet" type="text/css" href="jquery.fancybox.min.css">
<?php 

include 'template.php';
include "connection.php";
require 'fb_init.php';
require 'fb_get_data.php';


			if(isset($_GET['view'])){
        $query = "SELECT a.`title`, u.`fb_id`, u.`fb_name`, u.`fb_picture`, a.`body`, a.`image`, a.`state`, u.`fb_link` FROM `anuncio` AS a INNER JOIN `user` AS u ON a.`fb_id` = u.`fb_id` WHERE a.`id`={$_GET['view']}";
				$result = $mysqli->query($query);
				while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
            $user_fb_id = $result1["fb_id"];
            $user_fb_name = $result1["fb_name"];
            $user_fb_picture = $result1["fb_picture"];
            $user_fb_link = $result1["fb_link"];
            $advert_title = $result1["title"];
            $advert_body = $result1["body"];
            $advert_image = $result1["image"];
            $advert_state = $result1["state"];
        }
        //header('Location: advert.php');
    }else{
    if(isset($_SESSION['facebook_access_token'])){
				$query = "SELECT `id`, `title`, `state` FROM `anuncio` WHERE `fb_id` = {$userNode->getId()} ORDER BY `id` DESC";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
            $advert_id[] = $result1["id"];
            $advert_title[] = $result1["title"];
            $advert_state[] = $result1["state"];
        }
			}
	}
?>


<?php if(isset($user_fb_link)) { ?>
		<?php if($advert_state == 0 && $user_fb_id == $userNode->getId()) {
					echo '<div style="text-align:center; background-color: #ff0000;"><h4>Este anuncio fue bloqueado por el administrador</h4></div>';
				} ?>
			<div style="background-color: rgba(255, 255, 255, 0.5); padding-bottom: 20px;">
				<div class="row">
					<div class="col-md-8">
						<h1 style="text-align:center;"><?php echo $advert_title; ?></h1>
						
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-width: 256px; height:256px; margin: auto;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php foreach(explode(",", $advert_image) as $key => $img){
    if($key == 0){
      echo '<li data-target="#carousel-example-generic-'.$result1["id"].'" data-slide-to="0" class="active"></li>';
    }else{
      echo '<li data-target="#carousel-example-generic-'.$result1["id"].'" data-slide-to="'.$key.'"></li>';
    }} ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
		<?php foreach(explode(",", $advert_image) as $key => $img){
	if($key == 0){
    echo '<div class="item active">';
	}else{
    echo '<div class="item">';
	}echo '<a data-fancybox="group" data-src="#single_image-'.$result1["id"].'-'.$key.'" href="javascript:;"">
      <img id="single_image-'.$result1["id"].'-'.$key.'" src="'.$img.'" alt="..." style="width: 75%; display: none;">
      <img src="'.$img.'" alt="..." style="max-width: 256px; height:256px;">
      </a>
    </div>'; } ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
						
							<div style="display:block; margin: auto; width: 75%;"><?php echo $advert_body; ?></div>
					</div>
					<div style="text-align:center;" class="col-md-4">
						<h2>Usuario</h2>
						<a style="display:block;" href="<?php echo $user_fb_link; ?>">
							<img src="<?php echo $user_fb_picture;?>" width="128" height="128" alt="" title="">
						</a>
						<a style="display:block;" href="<?php echo $user_fb_link; ?>" target="_blank"><span><?php echo $user_fb_name; ?></span></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-1">
						<div class="fb-comments" data-href="https://proyectoweb032017.ddns.net/advert.php?view=<?php echo $_GET['view']; ?>" data-width="550" data-numposts="5"></div>
					</div>
					<div class="col-md-4 col-md-offset-1" style="text-align: center;">
						<div class="fb-share-button" data-href="https://proyectoweb032017.ddns.net/advert.php?view=<?php echo $_GET['view']; ?>" data-layout="button" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fproyectoweb032017.ddns.net%2F&amp;src=sdkpreparse">Compartir</a></div>
					</div>
				</div>
			</div>
<?php } ?>
<?php if(isset($advert_id)) { ?>
<div align="center">
    <h1>Anuncios</h1>
	<table style="background-color: white;" class="table table-striped table-bordered table-hover table-condensed">
		<thead>
        <tr>
            <th>Anuncio</th>
						<th>Estado</th>
            <th>Accion</th>
        </tr>
		</thead>
		<tbody>
        <?php
            
            foreach($advert_id as $key => $id){
							if($advert_state[$key] == 1){
                echo '<tr class="success"><td><a href="advert.php?view='.$id.'">'.$advert_title[$key].'</a></td><td><span>Activo</span></td><td><a href="create_advert.php?edit='.$id.'">Editar</a></td></tr>';
							}else{
								echo '<tr class="danger"><td><a href="advert.php?view='.$id.'">'.$advert_title[$key].'</a></td><td><span>Inactivo</span></td><td><a href="create_advert.php?edit='.$id.'">Editar</a></td></tr>';
							}
						}
        ?>
		</tbody>
	</table>
	<?php } ?>
</div>
<script src="jquery.fancybox.min.js"></script>