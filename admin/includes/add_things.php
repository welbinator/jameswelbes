<?php
if (isset($_POST['add_things'])) {
    // Sanitize input data for database insertion
    $things_title = mysqli_real_escape_string($connection, trim($_POST['things_title']));
    $things_permalink = filter_var(trim($_POST['things_permalink']), FILTER_SANITIZE_URL);
    $things_tagline = mysqli_real_escape_string($connection, trim($_POST['things_tagline']));
    $things_desc = mysqli_real_escape_string($connection, trim($_POST['things_desc']));
    $things_link = filter_var(trim($_POST['things_link']), FILTER_SANITIZE_URL);

    // Handle file upload
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5000000; // 5 MB
    $uploadDir = "../images/index/";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $maxFileSize) {
            $things_image = basename($_FILES['image']['name']);
            $things_image_temp = $_FILES['image']['tmp_name'];
            $uploadFile = $uploadDir . $things_image;

            // Move the uploaded file
            if (move_uploaded_file($things_image_temp, $uploadFile)) {
                // Compress the image
                $src_url = $uploadDir . $things_image;
                $destination_url = "../images/index/thumbnails/$things_image";
                compress_image($src_url, $destination_url, 60);

                if (!$connection) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                // Insert data using prepared statements
                $query = "INSERT INTO things (things_title, things_permalink, things_image, things_tagline, things_desc, things_link) VALUES (?, ?, ?, ?, ?, ?)";
                if ($stmt = $connection->prepare($query)) {
                    $stmt->bind_param("ssssss", $things_title, $things_permalink, $things_image, $things_tagline, $things_desc, $things_link);
                    $stmt->execute();

                    if ($stmt->error) {
                        echo "<p class='bg-danger'>Error: " . htmlspecialchars($stmt->error) . "</p>";
                    } else {
                        echo "<p class='bg-success'>Things Added Successfully.</p>";
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

<!-- HTML Form for adding new things -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="things_title">Title</label>
        <input type="text" class="form-control" name="things_title" required>
    </div>

    <div class="form-group">
        <label for="things_tagline">Tagline</label>
        <input type="text" class="form-control" name="things_tagline" required>
    </div>

    <div class="form-group">
        <label for="things_permalink">Permalink</label>
        <input type="text" class="form-control" name="things_permalink" required>
    </div>

    <div class="form-group">
        <label for="things_link">URL</label>
        <input type="url" class="form-control" name="things_link" required>
    </div>

    <div class="form-group">
        <label for="things_desc">Description</label>
        <textarea class="form-control" name="things_desc" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="things_image">Image</label>
        <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.gif" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_things" value="Publish">
    </div>
</form>
