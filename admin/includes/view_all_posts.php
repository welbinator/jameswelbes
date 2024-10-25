<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Select all posts from the database
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);

        // Loop through the posts and display each one in a table row
        while ($row = mysqli_fetch_assoc($select_posts)) {
            // Sanitize output to prevent XSS
            $post_id = htmlspecialchars($row['post_id'], ENT_QUOTES, 'UTF-8');
            $post_title = htmlspecialchars($row['post_title'], ENT_QUOTES, 'UTF-8');
            $post_image = htmlspecialchars($row['post_image'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_title}</td>";
            echo "<td><img width='100' src='../images/thumbnails/{$post_image}' alt='Post Image'></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
