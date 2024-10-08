<div id="things">
  <?php
    // Query to fetch all 'things' from the database
    $query = "SELECT * FROM things";
    $select_all_things_query = mysqli_query($connection, $query);

    // Loop through each 'things' entry and display it
    while ($row = mysqli_fetch_assoc($select_all_things_query)) {
        // Sanitize output to prevent XSS
        $things_title = htmlspecialchars($row['things_title'], ENT_QUOTES, 'UTF-8');
        $things_tagline = htmlspecialchars($row['things_tagline'], ENT_QUOTES, 'UTF-8');
        $things_image = htmlspecialchars($row['things_image'], ENT_QUOTES, 'UTF-8');
        $things_id = htmlspecialchars($row['things_id'], ENT_QUOTES, 'UTF-8');
        $things_permalink = htmlspecialchars($row['things_permalink'], ENT_QUOTES, 'UTF-8');
        $things_desc = htmlspecialchars($row['things_desc'], ENT_QUOTES, 'UTF-8');
        $things_link = htmlspecialchars($row['things_link'], ENT_QUOTES, 'UTF-8');
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
