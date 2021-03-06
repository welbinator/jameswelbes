<?php






if (isset($_POST['create_post'])) {



  $post_title = $_POST['title'];
  // $post_author = $_POST['author'];
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  //$post_tags = $_POST['post_tags'];
  $post_content = escape($_POST['post_content']);
  $post_date = date('d-m-y');
  //   $post_comment_count = 4;
  $post_desc = $_POST['desc'];


  move_uploaded_file($post_image_temp, "../images/posts/$post_image");

  $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_image, post_content, post_status, post_desc) ";

  $query .= "VALUES({$post_category_id},'{$post_title}',now(),'{$post_image}','{$post_content}','{$post_status}', '{$post_desc}' ) ";

  $create_post_query = mysqli_query($connection, $query);

  confirm($create_post_query);

  $the_post_id = mysqli_insert_id($connection); // this apparently pulls the last created id from this db table

  echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a></p>";
}


?>


<form action="" method="post" enctype="multipart/form-data">
  <!-- enctype is because we're uploading an image -->

  <div class="form-group"><label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class="form-group"><label for="category">Category</label><br>
    <select name="post_category" id="post_category">


      <?php
      $query = "SELECT * FROM categories"; //"SELECT * FROM categories LIMIT 3" to limit to 3 categories
      $select_categories = mysqli_query($connection, $query);


      confirm($select_categories);


      while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];


        echo "<option value='{$cat_id}'>{$cat_title}</option>";
      };
      ?>





    </select>
  </div>



  <div class="form-group">

    <select class="" name="post_status">
      <option value="">Post Status</option>
      <option value="Published">Published</option>
      <option value="Draft">Draft</option>
    </select>

  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div>

  <!--   <div class="form-group">
    <label for="post_tags">Post Tags</label>
  <input type="text" class="form-control" name="post_tags">
  </div> -->

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control textarea-editor" name="post_content" id="wysiwyg" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group"><label for="title">Post Description</label>
    <input type="text" class="form-control" name="desc">
  </div>

  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
  </div>








</form>