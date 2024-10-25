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
        // Select all portfolios from the database
        $query = "SELECT * FROM portfolio";
        $select_portfolios = mysqli_query($connection, $query);

        // Loop through each portfolio and display in the table
        while ($row = mysqli_fetch_assoc($select_portfolios)) {
            // Sanitize output to prevent XSS
            $portfolio_id = htmlspecialchars($row['portfolio_id'], ENT_QUOTES, 'UTF-8');
            $portfolio_title = htmlspecialchars($row['portfolio_title'], ENT_QUOTES, 'UTF-8');
            $portfolio_image = htmlspecialchars($row['portfolio_image'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>{$portfolio_id}</td>";
            echo "<td>{$portfolio_title}</td>";
            echo "<td><img width='100' src='../images/thumbnails/{$portfolio_image}' alt='Portfolio Image'></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
