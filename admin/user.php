<?php

    include 'template.php';
	include "../connection.php";
	
		
		$query = "SELECT `fb_id`, `fb_name`, `fb_link`, `state` FROM `user` ORDER BY `id` DESC";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
            $user_id[] = $result1["fb_id"];
            $user_name[] = $result1["fb_name"];
            $user_link[] = $result1["fb_link"];
            $user_state[] = $result1["state"];
        }

    if(isset($_GET['state'])){
        $query = "UPDATE `user` SET `state`={$_GET['setState']} WHERE `fb_id`={$_GET['state']}";
		$result = $mysqli->query($query);
        header('Location: user.php');
    }
?>

<div align="center">

    <h1>Usuarios</h1>

	<table style="background-color: white;" class="table table-striped table-bordered table-hover table-condensed">
		<thead>
        <tr>
            <th>Name</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Action</th>
        </tr>
		</thead>
		<tbody>
        <?php
            if(isset($user_id))
            foreach($user_id as $key => $id){
                if($user_state[$key] == 1){
		      			echo '<tr class="success"><td>'.$user_name[$key].'</td><td><a href="'.$user_link[$key].'" target="_blank">See</a></td><td>Activo</td><td><a href="user.php?state='.$id.'&setState=0">Lock</a></td></tr>';
                }else{
                echo '<tr class="danger"><td>'.$user_name[$key].'</td><td><a href="'.$user_link[$key].'" target="_blank">See</a></td><td>Bloqueado</td><td><a href="user.php?state='.$id.'&setState=1">Unlock</a></td></tr>';
              }
            }
        ?>
		</tbody>
	</table>

</div>