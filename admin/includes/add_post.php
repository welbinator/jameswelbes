<?php
// Assuming CSRF protection and database connection are initialized in the file that includes this script.


if (isset($_POST['create_post'])) {
    // Assuming a function check_csrf_token() is defined elsewhere and validates the CSRF token.
    // if (!check_csrf_token($_POST['csrf_token'])) {
    //     die("Invalid CSRF token.");
    // }

 

    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    

    // Sanitize and validate input data
    $post_title = strip_tags($_POST['title']); // Assuming no HTML is allowed
    $post_category_id = filter_input(INPUT_POST, 'post_category', FILTER_VALIDATE_INT); // Validation is key
    $post_status = strip_tags($_POST['post_status']); // Assuming no HTML is allowed
    $post_content = $purifier->purify($_POST['post_content']);
    $post_desc = strip_tags($_POST['desc']); // Assuming no HTML is allowed


    // Validate and handle the file upload
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5000000; // 5 MB
    $uploadDir = "../images/posts/";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $maxFileSize) {
            $post_image = basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $post_image;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // SQL query with prepared statement
                $query = "INSERT INTO posts (post_category_id, post_title, post_date, post_image, post_content, post_status, post_desc) VALUES (?, ?, NOW(), ?, ?, ?, ?)";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("isssss", $post_category_id, $post_title, $post_image, $post_content, $post_status, $post_desc);
                $stmt->execute();

                if ($stmt->error) {
                    echo "Error: " . $stmt->error;
                } else {
                    $the_post_id = $stmt->insert_id;
                    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id=" . htmlspecialchars($the_post_id) . "'>View Post</a> or <a href='posts.php'>Edit More Posts</a>.</p>";
                }
                $stmt->close();
            } else {
                echo "File upload failed.";
            }
        } else {
            echo "Invalid file type or size.";
        }
    } else {
        echo "Error in file upload.";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php// echo htmlspecialchars(generate_csrf_token()); ?>">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Category</label><br>
        <select name="post_category" id="post_category">
            <?php
            // Assuming $connection is your database connection
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = htmlspecialchars($row['cat_title']);
                echo "<option value='" . htmlspecialchars($cat_id) . "'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <select name="post_status">
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control textarea-editor" name="post_content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="desc">Post Description</label>
        <input type="text" class="form-control" name="desc">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>