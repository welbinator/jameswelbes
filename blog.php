<?php
// Include header
require_once "includes/header.php";
?>

<div class="container-fluid posts">
  <div class="row align-items-stretch">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <h2 class="text-white mb-4 text-center">My Ramblings</h2>

      <?php
      // Pagination
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $posts_per_page = 5;
      $offset = ($page > 1) ? ($page - 1) * $posts_per_page : 0;

      // Count total posts for pagination
      $post_query_count = "SELECT COUNT(*) AS total_posts FROM posts WHERE post_status = 'Published'";
      if ($stmt = $connection->prepare($post_query_count)) {
          $stmt->execute();
          $stmt->bind_result($total_posts);
          $stmt->fetch();
          $stmt->close();
      } else {
          $total_posts = 0;
      }

      $page_count = ceil($total_posts / $posts_per_page);

      // Fetch posts with pagination
      $query = "SELECT post_id, post_title, post_date, post_image, post_content, post_status FROM posts WHERE post_status = 'Published' LIMIT ?, ?";
      if ($stmt = $connection->prepare($query)) {
          $stmt->bind_param('ii', $offset, $posts_per_page);
          $stmt->execute();
          $result = $stmt->get_result();

          while ($row = $result->fetch_assoc()) {
              $post_id = htmlspecialchars($row['post_id'], ENT_QUOTES, 'UTF-8');
              $post_title = htmlspecialchars($row['post_title'], ENT_QUOTES, 'UTF-8');
              $post_date = htmlspecialchars($row['post_date'], ENT_QUOTES, 'UTF-8');
              $post_image = htmlspecialchars($row['post_image'], ENT_QUOTES, 'UTF-8');
              $post_content = substr(strip_tags($row['post_content']), 0, 200);
      ?>

      <div>
        <div class="row mb-5" data-aos="fade-up">
          <div class="col-md-12">
            <div class="d-flex blog-entry align-items-start flex-wrap">
              <div class="mr-5 img-wrap">
                <a href="single.php?p_id=<?php echo $post_id; ?>">
                  <img loading="lazy" src="images/posts/<?php echo $post_image; ?>" alt="Image" class="img-fluid">
                </a>
              </div>
              <div class="blog-archive-content-box">
                <h2 class="mt-0 mb-2">
                  <a href="single.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <div class="meta mb-3">Posted by James on <?php echo $post_date; ?></div>
                <p><?php echo $post_content; ?>... 
                  <a href="single.php?p_id=<?php echo $post_id; ?>">read more.</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
          }
          $stmt->close();
      } else {
          echo "<p>No posts found.</p>";
      }
      ?>

    </div>
  </div>
</div>

<?php
// Pagination Links (if needed)
if ($page_count > 1) {
    echo '<nav><ul class="pagination">';
    for ($i = 1; $i <= $page_count; $i++) {
        $active_class = ($i == $page) ? 'active' : '';
        echo "<li class='page-item $active_class'><a class='page-link' href='blog.php?page=$i'>$i</a></li>";
    }
    echo '</ul></nav>';
}
?>

<script>
  jQuery(document).ready(function () {
    var i = 0;
    var numPosts = $(".blog-entry").length;

    function f() {
      console.log("hi");
      i++;
      if (i < numPosts) {
        setTimeout(f, 3000);
      }
    }

    f();
  });
</script>

<?php
// Include footer
require_once "includes/footer.php";
?>
