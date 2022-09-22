<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="username" class="form-control" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                <small class="error_email" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="**********" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="**********" required>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="submit" name="admin_registerbtn" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
  <div class="mr-4 mb-3 mb-sm-0">
      <h1 class="mb-0 text-gray-800">Admins</h1>
      <div class="small"><span class="font-weight-500" id="ct"></span></div>
  </div>         
</div>

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
        Add Admin Profile 
      </button>
    </h6>
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

        $query = "SELECT * FROM admin_table";
        $query_run = mysqli_query($connection, $query);
        
    ?>

      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="d-none">ID </th>
            <th>Name </th>
            <th>Email </th>
            <th>Password</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
               ?>
          <tr>
            <td class="d-none"><?php  echo $row['id']; ?></td>
            <td><?php  echo $row['username']; ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td>**********</td>
            <td>
                <form action="admin_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn"><i class="fas fa-edit text-success"></i></button>
                </form>
            </td>
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="admin_deletebtn" class="btn"> <i class="fas fa-trash text-danger"></i></button>
                </form>
            </td>
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
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>