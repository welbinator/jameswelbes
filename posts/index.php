<?php
require_once "../includes/header-single.php";

$slug = isset($_GET['slug']) ? mysqli_real_escape_string($connection, $_GET['slug']) : '';

if (!$slug) {
    echo "<p class='text-danger'>No post found.</p>";
    require_once "../includes/footer.php";
    exit;
}

// Use LEFT JOIN so post still shows without a category
$query = "
    SELECT posts.*, categories.cat_title 
    FROM posts 
    LEFT JOIN categories ON categories.cat_id = posts.post_category_id 
    WHERE posts.post_slug = '$slug'
";

$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<p class='text-danger'>Post not found.</p>";
    require_once "../includes/footer.php";
    exit;
}

$row = mysqli_fetch_assoc($result);

$post_title    = $row['post_title'];
$post_author   = $row['post_author'];
$post_date     = $row['post_date'];
$post_image    = $row['post_image'];
$post_content  = $row['post_content'];
$post_category = $row['cat_title'] ?? 'Uncategorized'; // fallback
?>

<div class="container-fluid posts">
  <div class="row align-items-stretch">
    <div class="col-md-8" itemscope itemtype="http://schema.org/Article">
      <img loading="lazy" itemprop="image" class="img-responsive single-post-featured-image" src="/images/posts/<?php echo $post_image; ?>" alt="<?php echo htmlspecialchars($post_title); ?>">
      <h2><span itemprop="headline"><?php echo $post_title ?></span></h2>
      <hr class="category-divider">
      <h6 class="categories-meta"><?php echo $post_category; ?></h6>
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
