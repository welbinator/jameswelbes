<?php include "admin/db.php"; ?>
<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>James Welbes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include 'header-styles.php'; ?>
  <?php include 'header-scripts.php'; ?>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/6.5.1/css/font-awesome.min.css"> -->
  <!-- <script type='text/javascript' src="https://platform-api.sharethis.com/js/sharethis.js#property=5d3e2015c44880001354fca4&product='inline-share-buttons'" async='async'></script> -->



  <?php googleAnalytics(); ?>

</head>

<body>


  <div class="site-wrap">

    <header id="header" class="header-bar d-flex d-lg-block align-items-center aos-init aos-animate" data-aos="fade-left">
      <div id="site-logo" class="site-logo">
        <a href="home"><img loading="lazy" src="images/profilesticker.png" width="150" height="auto"></a>
      </div>
      <div class="mobile-menu-container hide" id="mobileMenu">
        <div class="inner">
          <span id="close" onclick="hideMenu();">X</span>
          <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/bio">Bio</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/webdesign">Web Design</a></li>
            <li><a href="/blog">Blog</a></li>
          </ul>

        </div>
        <!--inner-->

      </div>
      <!--mobile-menu-container-->



      <div class="mobile-menu-icon" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle  text-white"><span class="icon-menu h3" onclick="showMenu();"></span></a></div>

      <?php include "includes/navigation.php"; ?>
    </header>

    <main class="main-content">

      <script>
        function showMenu() {
          console.log("show");
          document.getElementById('mobileMenu').classList.remove("hide");
        }

        function hideMenu() {
          console.log("hide");
          document.getElementById('mobileMenu').classList.add("hide");

        

        }
      </script>