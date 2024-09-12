<div id="stuffs">
  <?php
    // Query to fetch all 'stuffs' from the database
    $query = "SELECT * FROM stuffs";
    $select_all_stuffs_query = mysqli_query($connection, $query);

    // Loop through each 'stuffs' entry and display it
    while ($row = mysqli_fetch_assoc($select_all_stuffs_query)) {
        // Sanitize output to prevent XSS
        $stuffs_title = htmlspecialchars($row['stuffs_title'], ENT_QUOTES, 'UTF-8');
        $stuffs_tagline = htmlspecialchars($row['stuffs_tagline'], ENT_QUOTES, 'UTF-8');
        $stuffs_image = htmlspecialchars($row['stuffs_image'], ENT_QUOTES, 'UTF-8');
        $stuffs_id = htmlspecialchars($row['stuffs_id'], ENT_QUOTES, 'UTF-8');
        $stuffs_permalink = htmlspecialchars($row['stuffs_permalink'], ENT_QUOTES, 'UTF-8');
        $stuffs_desc = htmlspecialchars($row['stuffs_desc'], ENT_QUOTES, 'UTF-8');
        $stuffs_link = htmlspecialchars($row['stuffs_link'], ENT_QUOTES, 'UTF-8');
  ?>
  
    <!-- Display each 'stuffs' entry in a card -->
    <div class="card" style="width: 18rem;">
      <div class="top-half">
        <img loading="lazy" class="" src="images/index/thumbnails/<?php echo $stuffs_image; ?>" alt="<?php echo $stuffs_title; ?>">
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $stuffs_title; ?></h5>
        <p class="card-text"><?php echo $stuffs_tagline; ?></p>
        <a data-fancybox data-src="#<?php echo $stuffs_permalink; ?>" href="#" class="btn">Learn More</a>
      </div>
    </div>
    
    <!-- Hidden content for FancyBox modal -->
    <div style="display:none;" id="<?php echo $stuffs_permalink; ?>">
      <?php echo $stuffs_desc; ?>
      <p><a href="<?php echo $stuffs_link; ?>" target="_blank"><?php echo $stuffs_link; ?></a></p>
    </div>

  <?php } // End of while loop ?>
</div> <!-- #stuffs -->
