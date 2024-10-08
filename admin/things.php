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
                    <h1 class="page-header">
                        Things
                    </h1>

                    <?php
                    // Check if 'source' is set, and sanitize it for security
                    $source = isset($_GET['source']) ? escape($_GET['source']) : '';

                    // Switch statement to load different pages based on 'source' parameter
                    switch ($source) {
                        case 'add_things':
                            require_once "includes/add_things.php";
                            break;
                        case 'edit_things':
                            require_once "includes/edit_things.php";
                            break;
                        default:
                            require_once "includes/view_all_things.php";
                            break;
                    }
                    ?>
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
