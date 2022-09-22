<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
  </div>
  <div class="card-body">
<?php

if(isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM admin_table WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>

          <form action="code.php" method="POST">
                
              <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
              
              <div class="form-group">
                  <label> Name </label>
                  <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter name" required>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email" required>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="**********" required>
              </div>

              <button type="submit" name="admin_updatebtn" class="btn btn-primary"> Update </button>
              <a href="add-admin.php" class="btn btn-danger" > Cancel  </a>

          </form>
    <?php
    }
}
?>
  </div>
  </div>
</div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>