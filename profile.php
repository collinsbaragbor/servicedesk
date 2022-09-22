<?php
include('security-2.php');
include('includes/header.php'); 
include('includes/navbar-2.php'); 
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Your Profile </h6>
  </div>
  <div class="card-body">
    <?php
        $user = $_SESSION['email'];
        
        $query = "SELECT * FROM user_table WHERE email='$user'";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($query_run);
      ?>

          <form action="code.php" method="POST">
                
              <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
            
            <div class="form-group">
                <label> Full name </label>
                <input type="text" name="edit_user_fullname" value="<?php  echo $row['fullname']; ?>" class="form-control" disabled="" placeholder="Full name">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <input class="form-control" type="text" value="<?php  echo $row['gender']; ?>" name="edit_user_gender" disabled="" placeholder="Gender"/>
            </div>
            <div class="form-group">
                <label>Department</label>
                <input class="form-control" type="text" value="<?php  echo $row['department']; ?>" name="edit_department" disabled="" placeholder="Department"/>
            </div>
            <div class="form-group"> 
                <label>Account Validity</label>
                <input class="form-control" type="date" value="<?php  echo $row['account_validity']; ?>" name="edit_account_validity" disabled="" placeholder="MM/DD/YYY"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="edit_user_email" value="<?php  echo $row['email']; ?>" class="form-control" disabled="" placeholder="Enter Email">
            </div>
          </form>
    <?php
    

?>
  </div>
  </div>
</div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>