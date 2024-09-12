<?php
// Include necessary files
require_once "admin/db.php";
require_once "functions.php";
?>

<?php


// Admin username and password
$username = 'james';
$password = 'pepsidude';

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the admin credentials into the database
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param('ss', $username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>James Welbes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Include header styles and scripts -->
  <?php include 'header-styles.php'; ?>
  <?php include 'header-scripts.php'; ?>

  <!-- Google Analytics (if applicable) -->
  <?php googleAnalytics(); ?>
</head>

<body>
  <div class="site-wrap">
    <!-- Header Section -->
    <header id="header" class="header-bar d-flex d-lg-block align-items-center" data-aos="fade-left">
      <div id="site-logo" class="site-logo">
        <a href="home">
          <img loading="lazy" src="images/profilesticker.png" width="150" height="auto" alt="James Welbes Profile Logo">
        </a>
      </div>

      <!-- Mobile Menu -->
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
      </div>

      <!-- Mobile Menu Icon -->
      <div class="mobile-menu-icon" style="position: relative; top: 3px;">
        <a href="#" class="site-menu-toggle text-white">
          <span class="icon-menu h3" onclick="showMenu();"></span>
        </a>
      </div>

      <!-- Include navigation -->
      <?php include "includes/navigation.php"; ?>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <script>
        function showMenu() {
          document.getElementById('mobileMenu').classList.remove("hide");
        }

        function hideMenu() {
          document.getElementById('mobileMenu').classList.add("hide");
        }
      </script>
