<?php
// Include admin header
require_once "admin_header.php";

?>

<div id="wrapper">
    
    <!-- Navigation -->
    <?php require_once "admin_navigation.php"; ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    
                    <h1 class="page-header">Posts</h1>

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
                            // Prepare the SQL query to prevent SQL injection
                            $query = "SELECT portfolio_id, portfolio_title, portfolio_image FROM portfolio";
                            if ($stmt = $connection->prepare($query)) {
                                // Execute the statement
                                $stmt->execute();

                                // Bind result variables
                                $stmt->bind_result($portfolio_id, $portfolio_title, $portfolio_image);

                                // Fetch and display the results
                                while ($stmt->fetch()) {
                                    // Escape output to prevent XSS
                                    $portfolio_id_escaped = htmlspecialchars($portfolio_id, ENT_QUOTES, 'UTF-8');
                                    $portfolio_title_escaped = htmlspecialchars($portfolio_title, ENT_QUOTES, 'UTF-8');
                                    $portfolio_image_escaped = htmlspecialchars($portfolio_image, ENT_QUOTES, 'UTF-8');

                                    echo "<tr>";
                                    echo "<td>{$portfolio_id_escaped}</td>";
                                    echo "<td>{$portfolio_title_escaped}</td>";
                                    echo "<td><img width='100' src='../{$portfolio_image_escaped}' alt='Portfolio Image'></td>";
                                    echo "</tr>";
                                }

                                // Close the statement
                                $stmt->close();
                            } else {
                                // Handle query error
                                echo "<tr><td colspan='3'>Error fetching portfolio data.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php
// Include admin footer
require_once "admin_footer.php";
?>
