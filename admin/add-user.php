<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<div class="modal fade" id="adduserprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label> Full name </label>
                  <input type="text" name="user_fullname" class="form-control" placeholder="Enter full name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Gender</label>
                  <select class="select form-control" name="user_gender" required>
                      <option value="" disabled selected>Choose gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Department</label>
                  <select class="select form-control" name="department" required>
                    <option value="" disabled selected>Choose Department</option>
                    <option value="Acquisition">Acquisition</option>
                    <option value="Catalogue">Catalogue</option>
                    <option value="Bindery">Bindery</option>
                    <option value="IAC">IAC</option>
                    <option value="Arikana">Arikana</option>
                    <option value="Students reference">Students reference</option>
                    <option value="Digitization">Digitization</option>
                    <option value="Archives">Archives</option>
                    <option value="Braille lab">Braille lab</option>
                    <option value="Research commons">Research commons</option>
                    <option value="Knowledge commons">Knowledge commons</option>
                    <option value="24hrs">24hrs</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group"> 
                  <label> Account Validity </label>
                  <input class="form-control" type="date" name="account_validity" placeholder="MM/DD/YYY" required/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="user_email" class="form-control" placeholder="Enter email" required>
              <small class="error_email" style="color: red;"></small>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="user_password" class="form-control" placeholder="**********" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control" placeholder="**********" required>
                </div>
              </div>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="submit" name="user_registerbtn" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
  <div class="mr-4 mb-3 mb-sm-0">
      <h1 class="mb-0 text-gray-800">Users</h1>
      <div class="small"><span class="font-weight-500" id="ct"></span></div>
  </div>         
</div>

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">User Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduserprofile">
              Add User Profile 
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

        $query = "SELECT * FROM user_table";
        $query_run = mysqli_query($connection, $query);
        
    ?>

      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="d-none">ID</th>
            <th>Full name</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Account Validity</th>
            <th>Email</th>
            <th>Password</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
              $original_date = $row['account_validity'];
              $timestamp = strtotime($original_date);
               ?>
          <tr>
            <td class="d-none"><?php  echo $row['id']; ?></td>
            <td><?php  echo $row['fullname']; ?></td>
            <td><?php  echo $row['gender']; ?></td>
            <td><?php  echo $row['department']; ?></td>
            <td><?php  echo date("d-m-Y", $timestamp); ?></td>
            <td><?php  echo $row['email']; ?></td>
            <td>**********</td>
            <td>
                <form action="user_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="user_editbtn" class="btn"><i class="fas fa-edit text-success"></i></button>
                </form>
            </td>
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="user_deletebtn" class="btn"> <i class="fas fa-trash text-danger"></i></button>
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