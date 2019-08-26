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
                            
                           
                            echo "<td><img width='100' src='../images/thumbnails/$portfolio_image'></td>";
                           
                            echo "</tr>";
                            
                            
                            
                          }
                          
                          ?>
                            
                        
                       
                      </tbody>
                      </table>