<?php include "admin_header.php"; ?>

    <div id="wrapper">




        <!-- Navigation -->
       <?php include "admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Sites

                        </h1>


                       <?php

                      if(isset($_GET['source'])){

                        $source = escape_string($_GET['source']);

                      } else {

                        $source = '';
                      }


                      switch($source) { // this uses the URL to include particular pages
                        case 'add_site';
                        include "includes/add_site.php";
                        break;
                        case 'edit_site';
                        include "includes/edit_site.php";
                        break;

                        default:

                          include "includes/view_all_sites.php";

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

   <?php include "admin_footer.php"; ?>
