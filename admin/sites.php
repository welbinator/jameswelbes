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
                        Sites
                    </h1>

                    <?php
                    // Check if 'source' is set and sanitize the input
                    $source = isset($_GET['source']) ? escape($_GET['source']) : '';

                    // Switch statement to load different pages based on 'source' parameter
                    switch ($source) {
                        case 'add_site':
                            require_once "includes/add_site.php";
                            break;
                        case 'edit_site':
                            require_once "includes/edit_site.php";
                            break;
                        default:
                            require_once "includes/view_all_sites.php";
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
