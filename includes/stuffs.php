<div id="stuffs">
       <?php
              $query = "SELECT * FROM stuffs";
              $select_all_stuffs_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc( $select_all_stuffs_query)) {

              $stuffs_title = $row['stuffs_title'];
              $stuffs_tagline = $row['stuffs_tagline'];
              $stuffs_image = $row['stuffs_image'];
              $stuffs_id = $row['stuffs_id'];
              $stuffs_permalink = $row['stuffs_permalink'];
              $stuffs_desc = $row['stuffs_desc'];
              $stuffs_link = $row['stuffs_link'];
                    
                      
         ?>
      
       
    <div class="card" style="width: 18rem;">
       <div class="top-half"> <img loading="lazy" class="" src="images/index/thumbnails/<?php echo $stuffs_image ?>" alt="Card image cap"></div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $stuffs_title ?></h5>
            <p class="card-text"><?php echo $stuffs_tagline ?></p>
             <a data-fancybox data-src="#<?php echo $stuffs_permalink; ?>" href class="btn">Learn More</a>
        </div>
    </div>
       
        
                 <div style="display:none;" id="<?php echo $stuffs_permalink; ?>"><?php echo $stuffs_desc; ?><p><a href="<?php echo $stuffs_link; ?>" target="_blank"><?php echo $stuffs_link; ?></a></p></div>
         
      
      <?php } ?>
            </div> <!-- stuffs -->