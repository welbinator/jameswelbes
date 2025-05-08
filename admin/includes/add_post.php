<?php

function generate_slug($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return rtrim($slug, '-');
}

if (isset($_POST['create_post'])) {
    

    // HTML Purifier configuration to sanitize post content
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    // Sanitize and validate input data
    $post_title = strip_tags($_POST['title']); // Strip HTML tags, allowing only plain text
    $post_slug = generate_slug($post_title);
    $post_category_id = filter_input(INPUT_POST, 'post_category', FILTER_VALIDATE_INT); // Validate category ID as integer
    $post_status = strip_tags($_POST['post_status']); // Strip HTML tags for status
    $post_content = $purifier->purify("Post Content");
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
                $query = "INSERT INTO posts (post_category_id, post_title, post_slug, post_date, post_image, post_status, post_content, post_desc) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?)";
                $stmt = $connection->prepare($query);
            
                if (!$stmt) {
                    die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
                }
            
                
                $stmt->bind_param("issssss", $post_category_id, $post_title, $post_slug, $post_image, $post_status, $post_content, $post_desc);
            
                if (!$stmt->execute()) {
                    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
                }
            
                if ($stmt->affected_rows > 0) {
                    $the_post_id = $stmt->insert_id;
                    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id=" . htmlspecialchars($the_post_id) . "'>View Post</a> or <a href='posts.php'>Edit More Posts</a>.</p>";
                } else {
                    echo "<p class='bg-danger'>No rows affected. Post was not created.</p>";
                }
            
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
<form action="posts.php?source=add_post" method="post" enctype="multipart/form-data">
   

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

    <!-- <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control textarea-editor" name="post_content" cols="30" rows="10" required></textarea>
    </div> -->

    <div class="form-group">
        <label for="desc">Post Description</label>
        <input type="text" class="form-control" name="desc" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
    </div>
</form>