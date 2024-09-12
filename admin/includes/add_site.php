<?php
if (isset($_POST['create_post'])) {
    // Sanitize input
    $portfolio_title = htmlspecialchars(trim($_POST['portfolio_title']), ENT_QUOTES, 'UTF-8');
    $portfolio_tagline = htmlspecialchars(trim($_POST['portfolio_tagline']), ENT_QUOTES, 'UTF-8');

    // Handle file upload
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5000000; // 5 MB
    $uploadDir = "../images/";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $maxFileSize) {
            $portfolio_image = basename($_FILES['image']['name']);
            $portfolio_image_temp = $_FILES['image']['tmp_name'];
            $uploadFile = $uploadDir . $portfolio_image;

            // Move the uploaded file
            if (move_uploaded_file($portfolio_image_temp, $uploadFile)) {
                // Compress the image
                $src_url = "../images/$portfolio_image";
                $destination_url = "../images/thumbnails/$portfolio_image";
                compress_image($src_url, $destination_url, 60);

                // Prepare the SQL query
                $query = "INSERT INTO portfolio (portfolio_title, portfolio_tagline, portfolio_image) VALUES (?, ?, ?)";
                if ($stmt = $connection->prepare($query)) {
                    $stmt->bind_param("sss", $portfolio_title, $portfolio_tagline, $portfolio_image);
                    $stmt->execute();

                    if ($stmt->error) {
                        echo "<p class='bg-danger'>Error: " . htmlspecialchars($stmt->error) . "</p>";
                    } else {
                        echo "<p class='bg-success'>Site Created Successfully.</p>";
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

<!-- HTML Form for adding a new site -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="portfolio_title">Title</label>
        <input type="text" class="form-control" name="portfolio_title" required>
    </div>

    <div class="form-group">
        <label for="portfolio_tagline">Tagline</label>
        <input type="text" class="form-control" name="portfolio_tagline" required>
    </div>

    <div class="form-group">
        <label for="portfolio_image">Image</label>
        <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.gif" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
</form>
