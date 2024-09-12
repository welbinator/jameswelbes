<?php
if (isset($_POST['add_stuffs'])) {
    // Sanitize input data
    $stuffs_title = htmlspecialchars(trim($_POST['stuffs_title']), ENT_QUOTES, 'UTF-8');
    $stuffs_permalink = htmlspecialchars(trim($_POST['stuffs_permalink']), ENT_QUOTES, 'UTF-8');
    $stuffs_tagline = htmlspecialchars(trim($_POST['stuffs_tagline']), ENT_QUOTES, 'UTF-8');
    $stuffs_desc = htmlspecialchars(trim($_POST['stuffs_desc']), ENT_QUOTES, 'UTF-8');

    // Handle file upload
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5000000; // 5 MB
    $uploadDir = "../images/index/";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $maxFileSize) {
            $stuffs_image = basename($_FILES['image']['name']);
            $stuffs_image_temp = $_FILES['image']['tmp_name'];
            $uploadFile = $uploadDir . $stuffs_image;

            // Move the uploaded file
            if (move_uploaded_file($stuffs_image_temp, $uploadFile)) {
                // Compress the image
                $src_url = $uploadDir . $stuffs_image;
                $destination_url = "../images/index/thumbnails/$stuffs_image";
                compress_image($src_url, $destination_url, 60);

                // Insert data using prepared statements
                $query = "INSERT INTO stuffs (stuffs_title, stuffs_permalink, stuffs_image, stuffs_tagline, stuffs_desc) VALUES (?, ?, ?, ?, ?)";
                if ($stmt = $connection->prepare($query)) {
                    $stmt->bind_param("sssss", $stuffs_title, $stuffs_permalink, $stuffs_image, $stuffs_tagline, $stuffs_desc);
                    $stmt->execute();

                    if ($stmt->error) {
                        echo "<p class='bg-danger'>Error: " . htmlspecialchars($stmt->error) . "</p>";
                    } else {
                        echo "<p class='bg-success'>Stuffs Added Successfully.</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<p class='bg-danger'>Failed to prepare the SQL statement.</p>";
                }
            } else {
                echo "<p class='bg-danger'>Failed to upload the file.</p>";
            }
        } else {
            echo "<p class='bg-danger'>Invalid file type or file size exceeds 5MB.</p>";
        }
    } else {
        echo "<p class='bg-danger'>Error in file upload.</p>";
    }
}
?>

<!-- HTML Form for adding new stuffs -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="stuffs_title">Title</label>
        <input type="text" class="form-control" name="stuffs_title" required>
    </div>

    <div class="form-group">
        <label for="stuffs_tagline">Tagline</label>
        <input type="text" class="form-control" name="stuffs_tagline" required>
    </div>

    <div class="form-group">
        <label for="stuffs_permalink">Permalink</label>
        <input type="text" class="form-control" name="stuffs_permalink" required>
    </div>

    <div class="form-group">
        <label for="stuffs_desc">Description</label>
        <textarea class="form-control" name="stuffs_desc" cols="30" rows="10" required></textarea>
    </div>

    <div class="form-group">
        <label for="stuffs_image">Image</label>
        <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.gif" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_stuffs" value="Publish">
    </div>
</form>
