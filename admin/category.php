<?php 

	include 'template.php';
include "../connection.php";
	
		$query = "SELECT `id`, `name` FROM `category`";
		$result = $mysqli->query($query);
		while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
            $cat_id[] = $result1["id"];
            $cat_name[] = $result1["name"];
        }
		if($_POST){
		$query = "INSERT INTO `category`(`name`) VALUES ('{$_POST['title']}')";
		$mysqli->query($query);
		header('Location: category.php');
	}
?>

<form method="post">
  <div class="form-group">
    <label for="exampleInputTitle">Titulo</label>
    <input type="text" class="form-control" id="exampleInputTitle" name="title" placeholder="Titulo" required>
  </div>
  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>

<div align="center">

    <h1>Categorias</h1>

	<table style="background-color: white;" class="table table-striped table-bordered table-hover table-condensed">
		<thead>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
		</thead>
		<tbody>
        <?php
            if(isset($cat_id))
            foreach($cat_id as $key => $id){
                echo '<tr><td>'.$cat_name[$key].'</td><td><a href="../category.php?cat='.$id.'">See</a></td></tr>';
            }
        ?>
		</tbody>
	</table>

</div>