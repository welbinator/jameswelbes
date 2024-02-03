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
                            Stuffs

                        </h1>


                       <?php

                      if(isset($_GET['source'])){

                        $source = escape_string($_GET['source']);

                      } else {

                        $source = '';
                      }


                      switch($source) { // this uses the URL to include particular pages
                        case 'add_stuffs';
                        include "includes/add_stuffs.php";
                        break;
                        case 'edit_stuffs';
                        include "includes/edit_stuffs.php";
                        break;

                        default:

                          include "includes/view_all_stuffss.php";

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
