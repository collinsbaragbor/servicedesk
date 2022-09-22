<?php
session_start();
include('includes/header.php'); 
?>




<div class="container">
<br><br><br><br>
<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <img src='img/logo.png' width="120px" height="80px"/>
                <h1 class="h4 text-gray-900 mb-4">Service Desk User Login</h1>
                <?php
                    //Error message here
                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h6 class="text-danger"> <i class="fas fa-exclamation-triangle text-danger"></i> &nbsp;'.$_SESSION['status'].' </h6>';
                        unset($_SESSION['status']);
                    }
                ?>
              </div>

                <form class="user" action="newcode.php" method="POST">

                    <div class="form-group">
                    <input type="email" name="user_email" class="form-control form-control-user" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                    <input type="password" name="user_password" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="userlogin_btn" class="btn btn-primary btn-user btn-block font-weight-bold">Login</button>
                    <hr>
                  <div class="text-center">
                    <a class="small" href="admin/admin-login.php">Login as Admin</a>
                  </div>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

</div>


<?php
include('includes/scripts.php'); 
include('includes/footer.php');
?>