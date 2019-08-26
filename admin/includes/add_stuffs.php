<?php

if(isset($_POST['add_stuffs'])) {
  

    $stuffs_title = $_POST['stuffs_title'];
    $stuffs_permalink = $_POST['stuffs_permalink'];
    $stuffs_image = $_FILES['image']['name'];
    $stuffs_image_temp = $_FILES['image']['tmp_name'];
    $stuffs_tagline = $_POST['stuffs_tagline'];
    $stuffs_desc = $_POST['stuffs_desc'];

  
  move_uploaded_file($stuffs_image_temp, "../images/index/$stuffs_image");
  
  
    $src_url = "../images/index/$stuffs_image";
    $destination_url = "../images/index/thumbnails/$stuffs_image"; 
  
    compress_image($src_url, $destination_url, 60);
    
  
  $query = "INSERT INTO stuffs(stuffs_title, stuffs_permalink, stuffs_image, stuffs_tagline, stuffs_desc) ";
  
  $query .= "VALUES('{$stuffs_title}','{$stuffs_permalink}','{$stuffs_image}','{$stuffs_tagline}','{$stuffs_desc}' ) ";
  
  
  $add_stuffs_query = mysqli_query($connection, $query);
  
  
   
  confirm($add_stuffs_query);
};


?>


<form action="" method="post" enctype="multipart/form-data"> <!-- enctype is because we're uploading an image -->


  
  <div class="form-group">
    <label for="stuffs_title">Title</label>
  <input type="text" class="form-control" name="stuffs_title">
  </div>
  
  <div class="form-group">
    <label for="stuffs_title">Tagline</label>
  <input type="text" class="form-control" name="stuffs_tagline">
  </div>
  
  <div class="form-group">
    <label for="stuffs_permalink">Permalink</label>
  <input type="text" class="form-control" name="stuffs_permalink">
  </div>
  
   <div class="form-group">
    <label for="stuffs_desc">Description</label>
    <textarea class="form-control" name="stuffs_desc" id="body" cols="30" rows="10"></textarea>
  </div>
  
  <div class="form-group">
    <label for="stuffs_image">Image</label>
  <input type="file" class="form-control" name="image">
  </div>
  
  
  
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="add_stuffs" value="Publish">
  </div>



</form>