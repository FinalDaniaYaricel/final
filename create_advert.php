<?php include 'template.php'; 

	include "connection.php";
	if(isset($_GET['edit'])){
			$query = "SELECT `cat_id`, `title`, `body`, `image` FROM `anuncio` WHERE `id`={$_GET['edit']}";
			$result = $mysqli->query($query);
			while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
				$cat_id = $result1['cat_id'];
				$title = $result1['title'];
				$body = $result1['body'];
				foreach(explode(",", $result1["image"]) as $key => $img){
					$image["exampleInputFile".($key+1)] = $img;
				}
			}
	}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
  <div hidden class="form-group">
    <label for="exampleInputId">Id</label>
    <input type="text" class="form-control" id="exampleInputId" name="id" placeholder="Id" value="<?php if(isset($_GET['edit'])) echo $_GET['edit']; else echo 0; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputTitle">Titulo</label>
    <input type="text" class="form-control" id="exampleInputTitle" name="title" placeholder="Titulo" value="<?php if(isset($_GET['edit'])) echo $title; ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleSelectCategory">Categoria</label>
		<select class="form-control" id="exampleSelectCategory" name="category" required>
			<option value="">Seleccione</option>
		<?php 
			$query = "SELECT `id`, `name` FROM `category`";
			$result = $mysqli->query($query);
			while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
				if(isset($_GET['edit']) && $result1["id"] == $cat_id){
	  			echo '<option value="'.$result1["id"].'" selected>'.$result1["name"].'</option>';
				}else{
	  			echo '<option value="'.$result1["id"].'">'.$result1["name"].'</option>';
				}
			}
		?>
		</select>
  </div>
  <div class="form-group">
    <label for="exampleInputFile1">Imagen 1</label>
<?php if(isset($image["exampleInputFile1"])){ ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" id="checkboxF1" name="checkboxF1" onclick="displayDivFile(this);"> Desea cambiar la imagen ?
			</label>
		</div>
		<img id="exampleInputFile1Actual" src="<?php echo $image["exampleInputFile1"]; ?>" alt="..." style="width: 256px; height:256px;">
<?php } ?>
		<div <?php if(isset($image["exampleInputFile1"])){ ?> hidden <?php } ?> id="exampleDivFileF1">
			<input type="file" name="fileToUpload[]" id="exampleInputFile1" <?php if(!isset($image["exampleInputFile1"])){ ?> required <?php } ?>>
			<div class="checkbox">
				<label>
					<input type="checkbox" id="checkbox2" onclick="displayDivFile(this);"> Desea subir una imagen mas ?
				</label>
			</div>
		</div>
  </div>
  <div class="form-group" <?php if(!isset($image["exampleInputFile2"])){ ?> hidden <?php } ?> id="exampleDivFile2">
    <label for="exampleInputFile2">Imagen 2</label>
<?php if(isset($image["exampleInputFile2"])){ ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" id="checkboxF2" name="checkboxF2" onclick="displayDivFile(this);"> Desea cambiar la imagen ?
			</label>
		</div>
		<img id="exampleInputFile2Actual" src="<?php echo $image["exampleInputFile2"]; ?>" alt="..." style="width: 256px; height:256px;">
<?php } ?>
		<div <?php if(isset($image["exampleInputFile2"])){ ?> hidden <?php } ?> id="exampleDivFileF2">
			<input type="file" name="fileToUpload[]" id="exampleInputFile2">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="checkbox3" onclick="displayDivFile(this);"> Desea subir una imagen mas ?
				</label>
			</div>
		</div>
  </div>
  <div class="form-group" <?php if(!isset($image["exampleInputFile3"])){ ?> hidden <?php } ?> id="exampleDivFile3">
    <label for="exampleInputFile3">Imagen 3</label>
<?php if(isset($image["exampleInputFile3"])){ ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" id="checkboxF3" name="checkboxF3" onclick="displayDivFile(this);"> Desea cambiar la imagen ?
			</label>
		</div>
		<img id="exampleInputFile3Actual" src="<?php echo $image["exampleInputFile3"]; ?>" alt="..." style="width: 256px; height:256px;">
<?php } ?>
		<div <?php if(isset($image["exampleInputFile3"])){ ?> hidden <?php } ?> id="exampleDivFileF3">
			<input type="file" name="fileToUpload[]" id="exampleInputFile3">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="checkbox4" onclick="displayDivFile(this);"> Desea subir una imagen mas ?
				</label>
			</div>
		</div>
  </div>
  <div class="form-group" <?php if(!isset($image["exampleInputFile4"])){ ?> hidden <?php } ?> id="exampleDivFile4">
    <label for="exampleInputFile4">Imagen 4</label>
<?php if(isset($image["exampleInputFile4"])){ ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" id="checkboxF4" name="checkboxF4" onclick="displayDivFile(this);"> Desea cambiar la imagen ?
			</label>
		</div>
		<img id="exampleInputFile4Actual" src="<?php echo $image["exampleInputFile4"]; ?>" alt="..." style="width: 256px; height:256px;">
<?php } ?>
		<div <?php if(isset($image["exampleInputFile4"])){ ?> hidden <?php } ?> id="exampleDivFileF4">
			<input type="file" name="fileToUpload[]" id="exampleInputFile4">
			<div class="checkbox" id="checkbox5">
				<label>
					<input type="checkbox" id="checkbox5" onclick="displayDivFile(this);"> Desea subir una imagen mas ?
				</label>
			</div>
		</div>
  </div>
  <div class="form-group" <?php if(!isset($image["exampleInputFile5"])){ ?> hidden <?php } ?> id="exampleDivFile5">
    <label for="exampleInputFile5">Imagen 5</label>
<?php if(isset($image["exampleInputFile5"])){ ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" id="checkboxF5" name="checkboxF5" onclick="displayDivFile(this);"> Desea cambiar la imagen ?
			</label>
		</div>
		<img id="exampleInputFile5Actual" src="<?php echo $image["exampleInputFile5"]; ?>" alt="..." style="width: 256px; height:256px;">
<?php } ?>
		<div <?php if(isset($image["exampleInputFile5"])){ ?> hidden <?php } ?> id="exampleDivFileF5">
			<input type="file" name="fileToUpload[]" id="exampleInputFile5">
			<p class="help-block">El limite es de 5 imagenes.</p>
		</div>
  </div>
  <div class="form-group" id="textarea">
    <label for="exampleTextArea">Cuerpo</label>
    <textarea class="form-control" rows="6" id="exampleTextArea" name="body" placeholder="Texto del anuncio ..." required><?php if(isset($_GET['edit'])) echo $body; ?></textarea>
  </div>

  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>

<script src="lib/js/wysihtml5-0.3.0.js"></script>
<script src="src/bootstrap-wysihtml5.js"></script>
<script>
	$('#exampleTextArea').wysihtml5();

	function displayDivFile(checkbox){
		if(checkbox.checked == true){
			if(checkbox.id == "checkboxF1")
				document.getElementById("exampleDivFileF1").style.display = "block";
			if(checkbox.id == "checkboxF2")
				document.getElementById("exampleDivFileF2").style.display = "block";
			if(checkbox.id == "checkboxF3")
				document.getElementById("exampleDivFileF3").style.display = "block";
			if(checkbox.id == "checkboxF4")
				document.getElementById("exampleDivFileF4").style.display = "block";
			if(checkbox.id == "checkboxF5")
				document.getElementById("exampleDivFileF5").style.display = "block";
			if(checkbox.id == "checkbox2")
				document.getElementById("exampleDivFile2").style.display = "block";
			if(checkbox.id == "checkbox3")
				document.getElementById("exampleDivFile3").style.display = "block";
			if(checkbox.id == "checkbox4")
				document.getElementById("exampleDivFile4").style.display = "block";
			if(checkbox.id == "checkbox5")
				document.getElementById("exampleDivFile5").style.display = "block";
		}else if(checkbox.checked == false){
			if(checkbox.id == "checkboxF1")
				document.getElementById("exampleDivFileF1").style.display = "none";
			if(checkbox.id == "checkboxF2")
				document.getElementById("exampleDivFileF2").style.display = "none";
			if(checkbox.id == "checkboxF3")
				document.getElementById("exampleDivFileF3").style.display = "none";
			if(checkbox.id == "checkboxF4")
				document.getElementById("exampleDivFileF4").style.display = "none";
			if(checkbox.id == "checkboxF5")
				document.getElementById("exampleDivFileF5").style.display = "none";
			if(checkbox.id == "checkbox2")
				document.getElementById("exampleDivFile2").style.display = "none";
			if(checkbox.id == "checkbox3")
				document.getElementById("exampleDivFile3").style.display = "none";
			if(checkbox.id == "checkbox4")
				document.getElementById("exampleDivFile4").style.display = "none";
			if(checkbox.id == "checkbox5")
				document.getElementById("exampleDivFile5").style.display = "none";
		}
	}
</script>
<style>
	.form-group#textarea ul.wysihtml5-toolbar{
		padding-top: 10px;
		border-radius: 5px;
	}
	.form-group#textarea ul{
		background-color: black;
	}
	.form-group#textarea iframe{
		width: 100% !important;
	}
</style>