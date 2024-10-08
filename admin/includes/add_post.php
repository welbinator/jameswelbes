<?php
// Assuming CSRF protection and database connection are initialized in the file that includes this script.

if (isset($_POST['create_post'])) {
    // CSRF token validation (uncomment if using CSRF protection)
    // if (!check_csrf_token($_POST['csrf_token'])) {
    //     die("Invalid CSRF token.");
    // }

    // HTML Purifier configuration to sanitize post content
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    // Sanitize and validate input data
    $post_title = strip_tags($_POST['title']); // Strip HTML tags, allowing only plain text
    $post_category_id = filter_input(INPUT_POST, 'post_category', FILTER_VALIDATE_INT); // Validate category ID as integer
    $post_status = strip_tags($_POST['post_status']); // Strip HTML tags for status
    $post_content = $purifier->purify($_POST['post_content']); // Purify post content to allow safe HTML
    $post_desc = strip_tags($_POST['desc']); // Strip HTML tags from description

    // File upload settings
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5000000; // 5 MB
    $uploadDir = "../images/posts/";

    // Handle file upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $maxFileSize) {
            $post_image = basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $post_image;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // Insert post into the database using prepared statements
                $query = "INSERT INTO posts (post_category_id, post_title, post_date, post_image, post_content, post_status, post_desc) VALUES (?, ?, NOW(), ?, ?, ?, ?)";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("isssss", $post_category_id, $post_title, $post_image, $post_content, $post_status, $post_desc);
                $stmt->execute();

                // Check for errors
                if ($stmt->error) {
                    echo "<p class='bg-danger'>Error: " . htmlspecialchars($stmt->error) . "</p>";
                } else {
                    $the_post_id = $stmt->insert_id;
                    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id=" . htmlspecialchars($the_post_id) . "'>View Post</a> or <a href='posts.php'>Edit More Posts</a>.</p>";
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "<p class='bg-danger'>File upload failed.</p>";
            }
        } else {
            echo "<p class='bg-danger'>Invalid file type or file too large. Only JPEG, PNG, and GIF files under 5MB are allowed.</p>";
        }
    } else {
        echo "<p class='bg-danger'>Error in file upload or no file uploaded.</p>";
    }
}
?>

<!-- HTML Form for adding a new post -->
<form action="" method="post" enctype="multipart/form-data">
    <!-- CSRF token (Uncomment the following line if using CSRF protection) -->
    <!-- <input type="hidden" name="csrf_token" value="<?php // echo htmlspecialchars(generate_csrf_token()); ?>"> -->

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
        <label for="category">Category</label><br>
        <select name="post_category" id="post_category" required>
            <?php
            // Fetch and display categories from the database
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = htmlspecialchars($row['cat_id']);
                $cat_title = htmlspecialchars($row['cat_title']);
                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <select name="post_status" required>
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.gif">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control textarea-editor" name="post_content" cols="30" rows="10" required></textarea>
    </div>

    <div class="form-group">
        <label for="desc">Post Description</label>
        <input type="text" class="form-control" name="desc" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
