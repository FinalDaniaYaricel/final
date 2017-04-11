<?php 

include 'template.php';
	include "../connection.php";

    if(isset($_SESSION['facebook_access_token'])){

		$query = "SELECT a.`id`, a.`fb_id`, a.`title`, a.`state`, u.`fb_link` FROM `anuncio` AS a INNER JOIN `user` AS u ON a.`fb_id` = u.`fb_id` ORDER BY a.`id` DESC";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
            $user_id[] = $result1["id"];
            $user_fb_id[] = $result1["fb_id"];
            $user_name[] = $result1["title"];
            $user_link[] = $result1["fb_link"];
            $user_state[] = $result1["state"];
        }
	}

    if(isset($_GET['state'])){
        $query = "UPDATE `anuncio` SET `state`={$_GET['setState']} WHERE `id`={$_GET['state']}";
		$result = $mysqli->query($query);
        header('Location: advert.php');
    }
?>

<div align="center">

    <h1>Anuncios</h1>

	<table style="background-color: white;" class="table table-striped table-bordered table-hover table-condensed">
		<thead>
        <tr>
            <th>Anuncio</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Action</th>
        </tr>
		</thead>
		<tbody>
        <?php
            if(isset($user_id))
            foreach($user_id as $key => $id){
                if($user_state[$key] == 1){
		      			echo '<tr class="success"><td><a href="../advert.php?view='.$id.'" target="_blank">'.$user_name[$key].'</a></td><td><a href="'.$user_link[$key].'" target="_blank">See</a></td><td>Activo</td><td><a href="advert.php?state='.$id.'&setState=0">Lock</a></td></tr>';
                }else{
                echo '<tr class="danger"><td><a href="../advert.php?view='.$id.'" target="_blank">'.$user_name[$key].'</a></td><td><a href="'.$user_link[$key].'" target="_blank">See</a></td><td>Bloqueado</td><td><a href="advert.php?state='.$id.'&setState=1">Unlock</a></td></tr>';
              }
            }
        ?>
		</tbody>
	</table>

</div>