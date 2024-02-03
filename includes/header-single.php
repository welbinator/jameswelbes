<?php include "admin/db.php"; ?>
<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>James Welbes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $post_desc; ?>" />
    <link rel="canonical" href="https://jameswelbes.com/single.php?p_id=<?php echo $post_id; ?>" />
    <link rel="publisher" href="https://jameswelbes.com" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $post_title; ?>" />
    <!-- <meta property="og:description" content="<?php echo $post_desc; ?>" /> -->
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
    <meta property="og:image:alt" content=' <?php echo $post_title; ?>' />
    <meta name="twitter:card" content="summary_large_image" />
    <!-- <meta name="twitter:description" content="<?php echo $post_desc; ?>" /> -->
    <meta name="twitter:title" content="<?php echo $post_title; ?>" />

    <meta name="twitter:image" content="https://jameswelbes.com/images/posts/<?php echo $post_image; ?>" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min-save.css">
  <!--     <link rel="stylesheet" href="css/magnific-popup.css"> -->
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.min.css">

  <link rel="stylesheet" href="css/aos.min.css">
  <link rel="stylesheet" href="css/fancybox.min.css">
  <link rel="stylesheet" href="css/animista.css">

  <link rel="stylesheet" href="css/keyframes.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/opening-animation.js"></script>
  <script src="js/opening-animation.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type='text/javascript' src="https://platform-api.sharethis.com/js/sharethis.js#property=5d3e2015c44880001354fca4&product='inline-share-buttons'" async='async'></script>



  <?php googleAnalytics(); ?>
  </head>
  <?php

  if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];
  }

  $query =    "
            SELECT * FROM posts JOIN categories ON categories.cat_id = posts.post_category_id && posts.post_id = $the_post_id
            ";

  $select_all_posts_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];

    $post_id = $row['post_id'];
    // $post_exerpt = substr($row['post_content'], 0, 200);
    $post_desc = $row['post_desc'];

  ?>

  <?php } ?>
  
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