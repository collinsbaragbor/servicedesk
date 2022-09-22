<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> EDIT User Profile </h6>
  </div>
  <div class="card-body">
<?php

if(isset($_POST['user_editbtn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM user_table WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>

          <form action="code.php" method="POST">
                
              <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
              
            <div class="form-group">
                <label> Full name </label>
                <input type="text" name="edit_user_fullname" value="<?php  echo $row['fullname']; ?>" class="form-control" placeholder="Enter Full name" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="select form-control" value="<?php  echo $row['gender']; ?>" name="edit_user_gender" required>
                    <option class="d-none" value="<?php  echo $row['gender']; ?>"><?php  echo $row['gender']; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Department</label>
                <select class="select form-control" name="edit_user_department" required>
                    <option class="d-none" value="<?php  echo $row['department']; ?>"><?php  echo $row['department']; ?></option>
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
            <div class="form-group"> 
                <label> Account Validity </label>
                <input class="form-control" type="date" value="<?php  echo $row['account_validity']; ?>" name="edit_account_validity" placeholder="MM/DD/YYY" required/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="edit_user_email" value="<?php  echo $row['email']; ?>" class="form-control" placeholder="Enter Email" required>
                <small class="error_email" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="edit_user_password" value="<?php  echo $row['password']; ?>" class="form-control" placeholder="Enter Password" required>
            </div>

              <button type="submit" name="user_updatebtn" class="btn btn-outline-primary"> Update </button>
              <a href="add-user.php" class="btn btn-outline-danger" > Cancel  </a>

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