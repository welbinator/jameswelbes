<?php include "includes/header.php"; ?>
<div class="container-fluid posts">
       <h2 class="" data-aos="fade-up">My Ramblings</h2><br>
      <div class="row align-items-stretch">
   

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php
              
              
              if(isset($_GET['page'])) { //pagination
                
                $page = $_GET['page'];
              } else {
                $page = "";
                
              }
              
              if($page == "" || $page == 1) {
                $page_1 = 0;
              } else {
                
                $page_1 = ($page * 5) - 5;
                  
              }
              
              
              
              
              $post_query_count = "SELECT * FROM posts";
              $find_count = mysqli_query($connection, $post_query_count);
              $count = mysqli_num_rows($find_count);
              
              $count = ceil($count / 5);
              
              
              $query = "SELECT * FROM posts LIMIT $page_1, 5";
              $select_all_posts_query = mysqli_query($connection, $query);
              
              while($row = mysqli_fetch_assoc( $select_all_posts_query)) {
                    
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                   // $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0, 500);
                    $post_status = $row['post_status'];
                      
                if ($post_status == 'Published') {
                  
                  
                
                    ?>
                
              



              
          
<h3><a href="post/<?php echo $post_id; ?>"><?php echo $post_title ?></a></h3>

<p class="lead">by James Welbes</a></p>
              
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p><hr>
              
<a href="post/<?php echo $post_id; ?>"><img class="img-responsive" src="images/posts/<?php echo $post_image; ?>" alt=""></a><hr>
              
<p><?php echo $post_content ?></p>
              
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
              
              
                
                 <?php }  } ?>
              
              
                

               

            </div>

           <?php include "includes/footer.php"; ?>
