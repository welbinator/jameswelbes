<?php
// Include header, using require_once for proper error handling
require_once "includes/header.php";
?>

<div class="container-fluid home">
  <h2 id="homeH2" class="text-white mb-4 text-center" data-aos="fade-up">Here are some stuffs I have done</h2>
  
  <div class="row index">
    <!-- Include portfolio stuffs, using require_once for consistency -->
    <?php require_once "includes/stuffs.php"; ?>
    
  </div>
</div>

<?php
// Include footer, using require_once for proper error handling
require_once "includes/footer.php";
?>
