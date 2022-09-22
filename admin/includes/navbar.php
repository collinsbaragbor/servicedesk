<ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin-dashboard.php">
    <div class="sidebar-brand-icon rotate-n-0">
      <img src='img/logo.png' width="100px" height="65px"/>
    </div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="admin-dashboard.php">
      <i class="fas fa-fw fa-chart-line"></i>
      <span>Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="tickets.php">
      <i class="fas fa-fw fa-clipboard-list"></i>
      <span>Tickets</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="notification.php">
      <i class="fas fa-fw fa-bell"></i>
      <span>Notifications</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="add-user.php">
      <i class="fas fa-fw fa-sitemap"></i>
      <span>Users</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="add-admin.php">
      <i class="fas fa-fw fa-plus-circle"></i>
      <span>Admin Profiles</span></a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggle -->
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
      <!-- Send notification Icon -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" data-toggle="modal" data-target="#notificationModal">
          <i class="fas fa-bullhorn text-info"></i>
        </a>
      </li>
      <?php
        $user = $_SESSION['email'];
        
        $query = "SELECT * FROM admin_table WHERE email='$user'";
        $query_run = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_run);
      ?>
      <div class="topbar-divider d-none d-sm-block"></div>

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-right text-gray-600 small">
            <strong><?php  echo $row['username']; ?></strong> <br>
            <?php echo $_SESSION['email']; ?>
          </span>
          <img class="img-profile rounded-circle" src="img/avatar.png">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="add-admin.php">
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
            <button type="submit" name="adminlogout_btn" class="btn btn-primary">Logout</button>
          </form>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<!-- Send Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group"> 
                <!-- <label> Notification Date </label> -->
                <input class="form-control" type="hidden" name="notification_date" value="<?php echo date("Y-m-d"); ?>" placeholder="MM/DD/YYY"/>
            </div>
            <div class="form-group">
              <label>Notification Description</label>
              <textarea name="notify_description" class="form-control" placeholder="Enter description here..." required></textarea>
            </div>
            <div class="form-group">
                <!-- Admin Name -->
                <input type="hidden" name="admin_name" class="form-control" value="<?php echo $row['username']; ?>" placeholder="Enter Admin Name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="notify_btn" class="btn btn-primary">Send</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>