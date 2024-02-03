<?php


                  

if(isset($_POST['create_post'])) {
  

    $portfolio_title = $_POST['portfolio_title'];
    $portfolio_tagline = $_POST['portfolio_tagline'];
    $portfolio_image = $_FILES['image']['name'];
    $portfolio_image_temp = $_FILES['image']['tmp_name'];

   

  
  move_uploaded_file($portfolio_image_temp, "../images/$portfolio_image");
  
  
    $src_url = "../images/$portfolio_image";
    $destination_url = "../images/thumbnails/$portfolio_image"; 
  
    compress_image($src_url, $destination_url, 60);
    
  
  $query = "INSERT INTO portfolio(portfolio_title, portfolio_tagline, portfolio_image) ";
  
  $query .= "VALUES('{$portfolio_title}','{$portfolio_tagline}','{$portfolio_image}' ) ";
  
  
  $create_post_query = mysqli_query($connection, $query);
  
  
   
    
  
  
  confirm($create_post_query);
};



     



?>


<form action="" method="post" enctype="multipart/form-data"> <!-- enctype is because we're uploading an image -->


  
  <div class="form-group">
    <label for="portfolio_title">Title</label>
  <input type="text" class="form-control" name="portfolio_title">
  </div>
  
  <div class="form-group">
    <label for="portfolio_tagline">Tagline</label>
  <input type="text" class="form-control" name="portfolio_tagline">
  </div>
  
  <div class="form-group">
    <label for="portfolio_image">Image</label>
  <input type="file" class="form-control" name="image">
  </div>
  
  
  
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
  </div>



</form>