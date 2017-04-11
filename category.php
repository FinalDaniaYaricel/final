<link rel="stylesheet" type="text/css" href="jquery.fancybox.min.css">
<?php 
include 'template.php'; 

include "connection.php";
$col_count = 0;
if(isset($_GET['cat'])){
        $query = "SELECT a.`id`, a.`title`, a.`image` FROM `anuncio` AS a INNER JOIN `user` AS u ON a.`fb_id` = u.`fb_id` WHERE a.`state`=1 AND u.`state`=1 AND a.`cat_id`={$_GET['cat']} ORDER BY a.`id` DESC LIMIT 9";
				$result = $mysqli->query($query);
				while($result1 = $result->fetch_array(MYSQLI_ASSOC)){
if($col_count == 0) {
  echo '<div class="row">';
} ?>

<div class="col-md-4" style="margin-bottom: 15px;">
  <div id="carousel-example-generic-<?php echo $result1['id']; ?>" class="carousel slide" data-ride="carousel" style="max-width: 256px; height:256px; margin: auto;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php foreach(explode(",", $result1["image"]) as $key => $img){
    if($key == 0){
      echo '<li data-target="#carousel-example-generic-'.$result1["id"].'" data-slide-to="0" class="active"></li>';
    }else{
      echo '<li data-target="#carousel-example-generic-'.$result1["id"].'" data-slide-to="'.$key.'"></li>';
    }} ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <?php foreach(explode(",", $result1["image"]) as $key => $img){
    if($key == 0){
      echo '<div class="item active">';
      }else{
      echo '<div class="item">';
      }
      echo '<a data-fancybox="group-'.$result1["id"].'" data-src="#single_image-'.$result1["id"].'-'.$key.'" href="javascript:;"">
      <img id="single_image-'.$result1["id"].'-'.$key.'" src="'.$img.'" alt="..." style="width: 75%; display: none;">
      <img src="'.$img.'" alt="..." style="width: 256px; height:256px;">
      </a>
        <div class="carousel-caption">
          <a href="advert.php?view='.$result1["id"].'"><h3>'.$result1["title"].'</h3></a>
        </div>
      </div>'; } ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic-<?php echo $result1['id']; ?>" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic-<?php echo $result1['id']; ?>" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<?php 

if($col_count == 2){
  echo '</div>';
  $col_count = 0;
}else{
  $col_count++;
}
        }} ?>
<script src="jquery.fancybox.min.js"></script>