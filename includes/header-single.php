<?php
// Include required files
require_once "admin/db.php";
require_once "functions.php";

// Sanitize input
if (isset($_GET['p_id'])) {
    $the_post_id = htmlspecialchars($_GET['p_id'], ENT_QUOTES, 'UTF-8');

    // Prepare the SQL query to prevent SQL injection
    $query = "SELECT * FROM posts JOIN categories ON categories.cat_id = posts.post_category_id WHERE posts.post_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $the_post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the post data
    $row = $result->fetch_assoc();

    // Sanitize the output
    if ($row) {
        $post_title = htmlspecialchars($row['post_title'], ENT_QUOTES, 'UTF-8');
        $post_author = htmlspecialchars($row['post_author'], ENT_QUOTES, 'UTF-8');
        $post_date = htmlspecialchars($row['post_date'], ENT_QUOTES, 'UTF-8');
        $post_image = htmlspecialchars($row['post_image'], ENT_QUOTES, 'UTF-8');
        $post_desc = htmlspecialchars($row['post_desc'], ENT_QUOTES, 'UTF-8');
        $post_id = htmlspecialchars($row['post_id'], ENT_QUOTES, 'UTF-8');
    } else {
        die('Post not found.');
    }

    $stmt->close();
} else {
    die('No post ID provided.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>James Welbes - <?php echo $post_title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $post_desc; ?>" />
  
  <link rel="canonical" href="https://jameswelbes.com/single.php?p_id=<?php echo $post_id; ?>" />
  <link rel="publisher" href="https://jameswelbes.com" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?php echo $post_title; ?>" />
  <meta property="og:description" content="<?php echo $post_desc; ?>" />
  <meta property="og:url" content="https://jameswelbes.com/single.php?p_id=<?php echo $post_id; ?>" />
  <meta property="og:site_name" content="James Welbes" />
  <meta property="article:publisher" content="https://jameswelbes.com" />
  <meta property="article:tag" content="freelance" />
  <meta property="article:tag" content="how to be successful freelancer" />
  <meta property="article:section" content="HTML" />
  <meta property="article:published_time" content="<?php echo $post_date; ?>" />
  <meta name="author" content="James Welbes">

  <meta property="og:image" content="https://jameswelbes.com/images/posts/<?php echo $post_image; ?>" />
  <meta property="og:image:secure_url" content="https://jameswelbes.com/images/posts/<?php echo $post_image; ?>" />
  <meta property="og:image:width" content="600" />
  <meta property="og:image:height" content="auto" />
  <meta property="og:image:alt" content="<?php echo $post_title; ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo $post_title; ?>" />
  <meta name="twitter:image" content="https://jameswelbes.com/images/posts/<?php echo $post_image; ?>" />

  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">

  <?php include 'header-styles.php'; ?>
  <?php include 'header-scripts.php'; ?>
  
  <?php googleAnalytics(); ?>
</head>

<body>
  <div class="site-wrap">

    <header id="header" class="header-bar d-flex d-lg-block align-items-center aos-init aos-animate" data-aos="fade-left">
      <div id="site-logo" class="site-logo">
        <a href="home"><img loading="lazy" src="images/profilesticker.png" width="150" height="auto" alt="James Welbes Profile Logo"></a>
      </div>

      <div class="mobile-menu-container hide" id="mobileMenu">
        <div class="inner">
          <span id="close" onclick="hideMenu();">X</span>
          <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/bio">Bio</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/webdesign">Web Design</a></li>
          </ul>
        </div>
      </div>

      <div class="mobile-menu-icon" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle text-white"><span class="icon-menu h3" onclick="showMenu();"></span></a></div>

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
