<?php
// Include header, using require_once to ensure the file is included only once and to trigger a fatal error if the file is missing
require_once "includes/header.php";
?>

<div class="container-fluid index">
  <h2 id="indexH2" class="text-white mb-4 text-center" data-aos="fade-up">Here are some stuffs I have done</h2>
  
  <div class="row index">
    <!-- Include portfolio stuffs, using require_once for better error handling -->
    <?php require_once "includes/stuffs.php"; ?>
    
    <div id="animation">
      <div id="quotes" class="fade">
        <div>
          <h1>"Putting quotes on landing pages is stupid."</h1><br>
          <h3>-James Welbes</h3>
        </div>
      </div>
    </div>

    <!-- Keep external JS in a separate file for better code organization -->
    <script>
      doAllTheThings(); // Ensure this function is defined in an external JS file
    </script>

  </div>
</div>

<!-- Remove commented-out code for cleaner output -->
<!-- Footer include -->
<?php
require_once "includes/footer.php";
?>
