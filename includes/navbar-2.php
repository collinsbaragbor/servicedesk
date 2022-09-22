<ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-0">
      <img src='img/logo.png' width="100px" height="65px"/>
    </div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="add-ticket.php">
      <i class="fas fa-fw fa-comments"></i>
      <span>Report Issues</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="profile.php">
      <i class="fas fa-fw fa-user"></i>
      <span>View Profile</span></a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
      <?php

        $query = "SELECT * FROM notifications ORDER BY id DESC";
        $query_run = mysqli_query($conn, $query);

      ?>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw text-success"></i>
          <!-- Counter - Alerts -->
          <?php
                    
            $query = "SELECT id FROM notifications ORDER BY id";  
            $query_run2 = mysqli_query($conn, $query);

            $row = mysqli_num_rows($query_run2);

            echo '<span class="badge badge-danger badge-counter">'.$row.'</span>';
          ?>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Notifications
          </h6>
          <?php
            if(mysqli_num_rows($query_run) > 0)        
            {
                while($row = mysqli_fetch_assoc($query_run))
                {
                  $original_date = $row['date_sent'];
                  $timestamp = strtotime($original_date);                  
                ?>
              <a class="dropdown-item d-flex align-items-center" href="">
                <div class="mr-3">
                  <div class="icon-circle bg-success">
                    <i class="fas fa-bell text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500"><?php  echo date("F j, Y", $timestamp); ?></div>
                  <span class="font-weight-bold"><?php echo $row['notification_content']; ?></span>
                </div>
              </a>
                  <?php
                } 
            }
            else {
                echo "No Record Found";
            }
            ?>
          <a class="dropdown-item text-center small text-gray-500" href="">Show All</a>
        </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>
      
      <li class="nav-item dropdown no-arrow">
        <?php
          $user = $_SESSION['email'];
          
          $query = "SELECT * FROM user_table WHERE email='$user'";
          $query_run = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($query_run);
        ?>
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-right text-gray-600 small">
            <strong><?php  echo $row['fullname']; ?></strong> <br>
            <?php echo $_SESSION['email']; ?>
          </span>
          <img class="img-profile rounded-circle" src="img/avatar.jpg">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="profile.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>

  </nav>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Want to Exit?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Click the logout button below if you want to logout.</div>
        <div class="modal-footer">
          <form action="logout.php" method="POST"> 
            <button type="submit" name="userlogout_btn" class="btn btn-primary">Logout</button>
          </form>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>