<?php

    include 'template.php';
    include 'user_valid.php';

    if(isset($_SESSION['facebook_access_token'])){
		
		$query = "SELECT `fb_id`, `fb_name`, `state` FROM `user`";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
            $user_id[] = $result1["fb_id"];
            $user_name[] = $result1["fb_name"];
            $user_state[] = $result1["state"];
        }
		//$mysqli->close();
	}

    if(isset($_GET['state'])){
        $query = "UPDATE `user` SET `state`={$_GET['setState']} WHERE `fb_id`={$_GET['state']}";
		$result = $mysqli->query($query);
        header('Location: user.php');
    }
?>

<div align="center">

    <h1>Usuarios</h1>

	<table>
        <tr>
            <th>Name</th>
            <th>Estado</th>
            <th>Action</th>
        </tr>
        <?php
            if(isset($user_id))
            foreach($user_id as $key => $id){
                if($user_state[$key] == 1){
		      echo '<tr><td>'.$user_name[$key].'</td><td>'.$user_state[$key].'</td><td><a href="user.php?state='.$id.'&setState=0">Lock</a></td></tr>';
                }else{
                echo '<tr><td>'.$user_name[$key].'</td><td>'.$user_state[$key].'</td><td><a href="user.php?state='.$id.'&setState=1">Unlock</a></td></tr>';
              }
            }
        ?>
	</table>

</div>