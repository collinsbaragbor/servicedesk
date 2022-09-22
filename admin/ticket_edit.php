<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> EDIT Ticket </h6>
  </div>
  <div class="card-body">
<?php

if(isset($_POST['ticket_editbtn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM ticket_table WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>

          <form action="code.php" method="POST">
                
              <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
            
            <div class="form-group"> 
                <label> Issue Date </label>
                <input class="form-control" type="date" readonly value="<?php  echo $row['issue_date']; ?>" name="edit_ticket_date" placeholder="MM/DD/YYY"/>
            </div>
            <div class="form-group">
                <label> Issue Description </label>
                <textarea name="edit_description" class="form-control" readonly placeholder="User issue goes here..."><?php  echo $row['issue_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label> Priority </label>
                <input type="text" name="edit_priority" readonly value="<?php  echo $row['priority']; ?>" class="form-control" placeholder="Priority">
            </div>  
            <div class="form-group">
                <label> Name </label>
                <input type="text" name="edit_user_name" readonly value="<?php  echo $row['issuer_fullname']; ?>" class="form-control" placeholder="Full name">
            </div>
            <div class="form-group">
                <label> ID </label>
                <input type="text" name="edit_user_id" readonly value="<?php  echo $row['issuer_id']; ?>" class="form-control" placeholder="User ID">
            </div>
            <div class="form-group">
                <label> Email </label>
                <input type="text" name="edit_user_email" readonly value="<?php  echo $row['user_email']; ?>" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label> Department </label>
                <input type="text" name="edit_department" readonly value="<?php  echo $row['department']; ?>" class="form-control" placeholder="Department">
            </div>
            <div class="form-group">
                <label> Status </label>
                <select class="select form-control" name="edit_ticket_status">
                    <option class="d-none" value="<?php  echo $row['ticket_status']; ?>"><?php  echo $row['ticket_status']; ?></option>
                    <option value="Reviewing">Reviewing</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
            <div class="form-group">
                <label>Admin Remarks</label>
                <textarea name="edit_admin_comment" class="form-control" placeholder="Enter your remarks here..." required><?php  echo $row['admin_comment']; ?></textarea>
            </div>
        
              <button type="submit" name="ticket_updatebtn" class="btn btn-outline-primary">Update</button>
              <a href="tickets.php" class="btn btn-outline-danger">Cancel</a>

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