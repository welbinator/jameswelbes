<?php include "includes/header.php"; ?>
<div class="container-fluid posts">
<!--        <h2 class="" data-aos="fade-up">My Ramblings</h2><br> -->
      <div class="row align-items-stretch">
   
            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <h2 class="text-white mb-4 text-center">My Ramblings</h2>

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
                    $post_content = substr($row['post_content'],0, 200);
                    $post_status = $row['post_status'];
                      
                if ($post_status == 'Published') {
                  
                  
                
                    ?>
                
              


              
          
<!-- <div class="col-md-8 pt-4"> -->
              <div>
          
          <div class="row mb-5" data-aos="fade-up">
            <div class="col-12">
             
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" data-aos="fade-up">
              <div class="d-flex blog-entry align-items-start">
                <div class="mr-5 img-wrap"><a href="single.php?p_id=<?php echo $post_id; ?>"><img loading="lazy" src="images/posts/<?php echo $post_image; ?>" alt="Image" class="img-fluid"></a></div>
                <div class="blog-archive-content-box">
                  <h2 class="mt-0 mb-2"><a href="single.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h2>
                  <div class="meta mb-3">Posted by James on <?php echo $post_date ?></div>
                  <p><?php echo $post_content; ?>... <a href="single.php?p_id=<?php echo htmlspecialchars($post_id, ENT_QUOTES, 'UTF-8'); ?>">read more.</a></p>

                  
                </div>
              </div>
            </div>


           

            
          </div>
        </div>
              
              
                
                 <?php  }  } ?>
         
            </div>

           

          <script>

          jQuery(document).ready(function() { 

          var i = 0;

          var numPosts = $(".blog-entry").length;
          function f() {
          console.log( "hi" );
          i++;
          if( i < numPosts ){
          setTimeout( f, 3000 );
          }
          }


          f();

          })


          </script>
<?php include "includes/footer.php"; ?>