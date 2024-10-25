<div id="things">
  <?php
    // Query to fetch all 'things' from the database, ordered by most recent
    $query = "SELECT * FROM things ORDER BY things_id DESC"; // Replace 'id' with 'created_at' if available and applicable
    $select_all_things_query = mysqli_query($connection, $query);

    // Check for query errors
    if (!$select_all_things_query) {
        die("Database query failed: " . mysqli_error($connection));
    }

    // Loop through each 'things' entry and display it
    while ($row = mysqli_fetch_assoc($select_all_things_query)) {
        // Sanitize and decode output to prevent XSS and display properly
        $things_title = htmlspecialchars_decode(stripslashes($row['things_title']), ENT_QUOTES);
        $things_tagline = htmlspecialchars_decode(stripslashes($row['things_tagline']), ENT_QUOTES);
        $things_image = htmlspecialchars_decode(stripslashes($row['things_image']), ENT_QUOTES);
        $things_id = htmlspecialchars_decode(stripslashes($row['things_id']), ENT_QUOTES);
        $things_permalink = htmlspecialchars_decode(stripslashes($row['things_permalink']), ENT_QUOTES);
        $things_desc = htmlspecialchars_decode(stripslashes($row['things_desc']), ENT_QUOTES);
        $things_link = htmlspecialchars_decode(stripslashes($row['things_link']), ENT_QUOTES);
  ?>
  
    <!-- Display each 'things' entry in a card -->
    <div class="card" style="width: 18rem;">
      <div class="top-half">
        <img loading="lazy" class="" src="images/index/thumbnails/<?php echo $things_image; ?>" alt="<?php echo $things_title; ?>">
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $things_title; ?></h5>
        <p class="card-text"><?php echo $things_tagline; ?></p>
        <a data-fancybox data-src="#<?php echo $things_permalink; ?>" href="#" class="btn">Learn More</a>
      </div>
    </div>
    
    <!-- Hidden content for FancyBox modal -->
    <div style="display:none;" id="<?php echo $things_permalink; ?>">
      <?php echo $things_desc; ?>
      <p><a href="<?php echo $things_link; ?>" target="_blank"><?php echo $things_link; ?></a></p>
    </div>

  <?php } // End of while loop ?>
</div> <!-- #things -->
