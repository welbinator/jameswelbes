<?php
// Include header, using require_once for proper error handling
require_once "includes/header.php";
?>

<div class="container-fluid home">
  <h2 id="homeH2" class="text-white mb-4 text-center" data-aos="fade-up">Here are some things I have done</h2>
  
  <div class="row index">
    <!-- Include portfolio things, using require_once for consistency -->
    <?php require_once "things.php"; ?>
    
  </div>
</div>

<?php
// Include footer, using require_once for proper error handling
require_once "includes/footer.php";
?>
