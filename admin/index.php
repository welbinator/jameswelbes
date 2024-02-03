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
                            Posts
                            
                        </h1>
<table class="table table-bordered table-hover">
                        <thead>
                          <th>Id</th>
                            
                            <th>Title</th>
                            
                            <th>Image</th>
                            
                          </tr>
                        </thead>
                      <tbody>
                          <?php
                          $query = "SELECT * FROM portfolio";
                          $select_portfolios = mysqli_query($connection, $query);
                          
                          while ($row = mysqli_fetch_assoc($select_portfolios)) {
                          $portfolio_id = $row['portfolio_id'];
                          
                            $portfolio_title = $row['portfolio_title'];
                            
                            $portfolio_image = $row['portfolio_image'];
                           
                            
                            echo "<tr>";
                            echo "<td>$portfolio_id</td>";
                           
                            echo "<td>$portfolio_title</td>";
                            
                           
                            echo "<td><img width='100' src='../$portfolio_image'></td>";
                           
                            echo "</tr>";
                            
                            
                            
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

   <?php include "admin_footer.php"; ?>
