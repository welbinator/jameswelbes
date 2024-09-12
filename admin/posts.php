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
                        Posts
                    </h1>

                    <?php
                    // Check if 'source' is set, and escape it for security
                    $source = isset($_GET['source']) ? escape($_GET['source']) : '';

                    // Switch between different views based on the source value
                    switch ($source) {
                        case 'add_post':
                            require_once "includes/add_post.php";
                            break;
                        case 'edit_post':
                            require_once "includes/edit_post.php";
                            break;
                        default:
                            require_once "includes/view_all_posts.php";
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
