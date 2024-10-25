<?php
// Include header
require_once "includes/header.php";
?>

<div class="container-fluid photos">
  <h2 id="homeH2" class="text-white mb-4 text-center" data-aos="fade-up">Website Design Portfolio</h2><br>
  
  <div class="row align-items-stretch">
    <?php
    // Use prepared statements to avoid SQL injection
    $query = "SELECT portfolio_title, portfolio_tagline, portfolio_image, portfolio_id FROM portfolio ORDER BY portfolio_id DESC";
    
    // Prepare the statement
    if ($stmt = $connection->prepare($query)) {
        // Execute the statement
        $stmt->execute();
        
        // Bind result variables
        $stmt->bind_result($portfolio_title, $portfolio_tagline, $portfolio_image, $portfolio_id);
        
        // Counter for column size management
        $count = 1;
        
        // Fetch values in a loop
        while ($stmt->fetch()) {
          // Escape output to prevent XSS attacks
          $portfolio_title_escaped = htmlspecialchars($portfolio_title, ENT_QUOTES, 'UTF-8');
          $portfolio_tagline_escaped = htmlspecialchars($portfolio_tagline, ENT_QUOTES, 'UTF-8');
          $portfolio_image_escaped = htmlspecialchars($portfolio_image, ENT_QUOTES, 'UTF-8');
    ?>

      <div class="col-6 col-md-6 col-lg-<?php randCol($count); ?>" data-aos="fade-up">
        <a data-fancybox="gallery" href="images/<?php echo $portfolio_image_escaped; ?>" class="d-block photo-item">
          <img loading="lazy" src="images/thumbnails/<?php echo $portfolio_image_escaped; ?>" alt="Image" class="img-fluid">
          <div class="photo-text-more">
            <h3 class="heading"><?php echo $portfolio_title_escaped; ?></h3>
            <span class="meta"><?php echo $portfolio_tagline_escaped; ?></span>
          </div>
        </a>
      </div>

    <?php
          $count++;
        }
        // Close the statement
        $stmt->close();
    } else {
        // Handle query error
        echo "<p>Error fetching portfolio items.</p>";
    }
    ?>
    
  </div> <!-- row align-items-stretch -->
</div> <!-- container-fluid photos -->

<?php
// Include footer
require_once "includes/footer.php";
?>
