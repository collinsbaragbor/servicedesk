<?php 
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>


        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="mr-4 mb-3 mb-sm-0">
                <h1 class="mb-0 text-gray-800">Dashboard</h1>
                <div class="small"><span class="font-weight-500" id="ct"></span></div>
            </div>         
          </div>
          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Issues</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">

                        <?php
                    
                          $query = "SELECT id FROM ticket_table ORDER BY id";  
                          $query_run = mysqli_query($connection, $query);

                          $row = mysqli_num_rows($query_run);

                          echo '<h5 class="h5 mb-0 font-weight-bold text-gray-800">'.$row.'</h5>';
                        ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Issues</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">

                       <?php
                    
                          $query = "SELECT id FROM ticket_table WHERE ticket_status = 'Pending' ";  
                          $query_run = mysqli_query($connection, $query);

                          $row = mysqli_num_rows($query_run);

                          echo '<h5 class="h5 mb-0 font-weight-bold text-gray-800">'.$row.'</h5>';
                        ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-question fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Opened Issues</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        
                        <?php
                    
                              $query = "SELECT id FROM ticket_table WHERE ticket_status = 'Reviewing'";  
                              $query_run = mysqli_query($connection, $query);

                              $row = mysqli_num_rows($query_run);

                              echo '<h5 class="h5 mb-0 font-weight-bold text-gray-800">'.$row.'</h5>';
                            ?>
                      
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-edit fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Closed Issues</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                            <?php
                    
                              $query = "SELECT id FROM ticket_table WHERE ticket_status = 'Closed'";  
                              $query_run = mysqli_query($connection, $query);

                              $row = mysqli_num_rows($query_run);

                              echo '<h5 class="h5 mb-0 font-weight-bold text-gray-800">'.$row.'</h5>';
                            ?>
                        
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>       
        </div>
      </div>    
      
      <div class="container-fluid">
        <br>
        <h1 class="h3 mb-2 text-gray-800">Tickets</h1>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tickets</h6>
          </div>

          <div class="card-body">
            <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            {
              echo '<h5 class="text-success"> '.$_SESSION['success'].' </h5>';
              unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
              echo '<h5 class="text-info"> '.$_SESSION['status'].' </h5>';
              unset($_SESSION['status']);
            }
            ?>

            <div class="table-responsive">

            <?php

                $query = "SELECT * FROM ticket_table";
                $query_run = mysqli_query($connection, $query);
                
            ?>

              <table class="table table-bordered table-hover" id="dataTableSort" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="d-none">ID</th>
                    <th>Issue Date</th>
                    <th>Issue Description</th>
                    <th>Priority</th>
                    <th>Name</th>
                    <th>User ID</th>
                    <th>Department</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if(mysqli_num_rows($query_run) > 0)        
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                      $var = $row['ticket_status'];
                      $original_date = $row['issue_date'];
                      $timestamp = strtotime($original_date);
                      ?>
                  <tr>
                    <td class="d-none"><?php  echo $row['id']; ?></td>
                    <td><?php  echo date("d-m-Y", $timestamp); ?></td>
                    <td><?php  echo $row['issue_description']; ?></td>
                    <td><?php  echo $row['priority']; ?></td>
                    <td><?php  echo $row['issuer_fullname']; ?></td>
                    <td><?php  echo $row['issuer_id']; ?></td>
                    <td><?php  echo $row['department']; ?></td>
                    <td style="color:<?=($var=="Reviewing")?'#2689b2':(($var=="Closed")?'#1cc88a':'#f6c23e')?>"><?php echo $row['ticket_status']; ?></td>
                  </tr>
                  <?php
                    } 
                }
                else {
                    echo "No Record Found";
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

  
<?php 
include('includes/scripts.php');
include('includes/footer.php');
?>
  

  

