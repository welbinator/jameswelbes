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
        // Select all things from the database
        $query = "SELECT * FROM things";
        $select_things = mysqli_query($connection, $query);

        // Loop through each stuff and display in the table
        while ($row = mysqli_fetch_assoc($select_things)) {
            // Sanitize output to prevent XSS
            $things_id = htmlspecialchars($row['things_id'], ENT_QUOTES, 'UTF-8');
            $things_title = htmlspecialchars($row['things_title'], ENT_QUOTES, 'UTF-8');
            $things_image = htmlspecialchars($row['things_image'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>{$things_id}</td>";
            echo "<td>{$things_title}</td>";
            echo "<td><img width='100' src='../images/thumbnails/{$things_image}' alt='Stuff Image'></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
