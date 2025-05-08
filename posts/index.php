<?php
require_once "../includes/header-single.php";

// DEBUG: Output raw query string for verification
echo "<pre>DEBUG: \$_GET = "; print_r($_GET); echo "</pre>";

// Sanitize the slug
$slug = isset($_GET['slug']) ? mysqli_real_escape_string($connection, $_GET['slug']) : '';

// DEBUG: Show the resolved slug
echo "<p><strong>DEBUG: Slug =</strong> '$slug'</p>";

if (!$slug) {
    echo "<p class='text-danger'>No post found.</p>";
    require_once "../includes/footer.php";
    exit;
}

// Query post by slug (no JOIN)
$query = "SELECT * FROM posts WHERE post_slug = '$slug'";
echo "<p><strong>DEBUG: SQL Query =</strong> $query</p>"; // Show query
$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<p class='text-danger'>Post not found.</p>";
    require_once "../includes/footer.php";
    exit;
}

if (mysqli_num_rows($result) === 0) {
  echo "<p class='text-danger'>Post not found (no rows returned).</p>";
  require_once "../includes/footer.php";
  exit;
}

$row = mysqli_fetch_assoc($result);

$post_title    = $row['post_title'];
$post_author   = $row['post_author'];
$post_date     = $row['post_date'];
$post_image    = $row['post_image'];
$post_content  = $row['post_content'];
?>

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

<?php require_once "../includes/footer.php"; ?>
