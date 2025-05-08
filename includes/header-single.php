<?php
// Basic layout includes
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>James Welbes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="canonical" href="https://jameswelbes.com" />
  <link rel="publisher" href="https://jameswelbes.com" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="James Welbes" />

  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">

  <?php include __DIR__ . '/../includes/header-styles.php'; ?>
<?php include __DIR__ . '/../includes/header-scripts.php'; ?>


  <?php googleAnalytics(); ?>
</head>

<body>
  <div class="site-wrap">

    <header id="header" class="header-bar d-flex d-lg-block align-items-center aos-init aos-animate" data-aos="fade-left">
      <div id="site-logo" class="site-logo">
        <a href="home"><img loading="lazy" src="/images/profilesticker.png" width="150" alt="James Welbes Profile Logo"></a>
      </div>

      <div class="mobile-menu-container hide" id="mobileMenu">
        <div class="inner">
          <span id="close" onclick="hideMenu();">X</span>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/bio">Bio</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/webdesign">Web Design</a></li>
          </ul>
        </div>
      </div>

      <div class="mobile-menu-icon"><a href="#" class="site-menu-toggle text-white"><span class="icon-menu h3" onclick="showMenu();"></span></a></div>

      <?php include __DIR__ . '/../includes/navigation.php'; ?>

    </header>

    <main class="main-content">
      <script>
        function showMenu() {
          document.getElementById('mobileMenu').classList.remove("hide");
        }
        function hideMenu() {
          document.getElementById('mobileMenu').classList.add("hide");
        }
      </script>
