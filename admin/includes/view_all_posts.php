<table class="table table-bordered table-hover">
    <thead>
        <th>Id</th>

        <th>Title</th>

        <th>Image</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];

            $post_title = $row['post_title'];

            $post_image = $row['post_image'];


            echo "<tr>";
            echo "<td>$post_id</td>";

            echo "<td>$post_title</td>";


            echo "<td><img width='100' src='../images/thumbnails/$post_image'></td>";

            echo "</tr>";
        }

        ?>



    </tbody>
</table>