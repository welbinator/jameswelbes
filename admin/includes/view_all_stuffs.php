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
        // Select all stuffs from the database
        $query = "SELECT * FROM stuffs";
        $select_stuffs = mysqli_query($connection, $query);

        // Loop through each stuff and display in the table
        while ($row = mysqli_fetch_assoc($select_stuffs)) {
            // Sanitize output to prevent XSS
            $stuffs_id = htmlspecialchars($row['stuffs_id'], ENT_QUOTES, 'UTF-8');
            $stuffs_title = htmlspecialchars($row['stuffs_title'], ENT_QUOTES, 'UTF-8');
            $stuffs_image = htmlspecialchars($row['stuffs_image'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>{$stuffs_id}</td>";
            echo "<td>{$stuffs_title}</td>";
            echo "<td><img width='100' src='../images/thumbnails/{$stuffs_image}' alt='Stuff Image'></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
