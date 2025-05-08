<?php
echo "Reached index.php<br>";

// Step 1: Load dependencies
require_once "../includes/header-single.php";
echo "Loaded header-single.php<br>";

// Step 2: Get and sanitize slug
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
echo "Raw slug: $slug<br>";

if (!$slug) {
    echo "<p class='text-danger'>❌ No slug provided</p>";
    require_once "../includes/footer-single.php";
    exit;
}

// Step 3: Connect to DB and run query
$escaped_slug = mysqli_real_escape_string($connection, $slug);
echo "Escaped slug: $escaped_slug<br>";

$query = "SELECT * FROM posts WHERE post_slug = '$escaped_slug'";
echo "Running query: $query<br>";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "<p class='text-danger'>Query failed: " . mysqli_error($connection) . "</p>";
    require_once "../includes/footer-single.php";
    exit;
}

if (mysqli_num_rows($result) === 0) {
    echo "<p class='text-danger'>No post found for slug: $escaped_slug</p>";
    require_once "../includes/footer-single.php";
    exit;
}

$row = mysqli_fetch_assoc($result);
echo "Post found: " . htmlspecialchars($row['post_title']) . "<br>";

// Extract post data
$post_title    = $row['post_title'];
$post_author   = $row['post_author'];
$post_date     = $row['post_date'];
$post_image    = $row['post_image'];
$post_content  = $row['post_content'];

?>

<!-- Now render the post -->
<div class="container-fluid posts">
  <div class="row align-items-stretch">
    <div class="col-md-8" itemscope itemtype="http://schema.org/Article">
      <img loading="lazy" itemprop="image" class="img-responsive single-post-featured-image" src="/images/posts/<?php echo $post_image; ?>" alt="<?php echo htmlspecialchars($post_title); ?>">
      <h2><span itemprop="headline"><?php echo $post_title ?></span></h2>
      <hr class="category-divider">
      <p class="lead">
        by <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php echo $post_author ?></span></span>
      </p>
      <p><span class="glyphicon glyphicon-time"> Posted on <span itemprop="datePublished"><?php echo $post_date ?></span></span></p>
      <hr>
      <div class="post-content" itemprop="articleBody"><?php echo html_entity_decode($post_content); ?></div>
      <hr>
      <div class="sharethis-inline-share-buttons"></div>
    </div>
  </div>
</div>

<?php require_once "../includes/footer-single.php"; ?>
