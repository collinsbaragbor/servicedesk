<?php
include('security-2.php');
include('includes/header.php'); 
include('includes/navbar-2.php'); 
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> View Issue </h6>
  </div>
  <div class="card-body">
<?php

if(isset($_POST['requestbtn']))
{
    $id = $_POST['request_id'];
    
    $query = "SELECT * FROM ticket_table WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    foreach($query_run as $row)
    {
        ?>

          <form action="newcode.php" method="POST">
                
            <div class="form-group">
                <input type="hidden" name="request_id" value="<?php echo $row['id'] ?>" >
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Issue Date</label>
                  <input class="form-control" type="date" value="<?php  echo $row['issue_date']; ?>" name="issue_date" disabled="" placeholder="MM/DD/YYY"/>
                </div>
                <div class="form-group">
                  <label>Priority</label>
                  <input class="form-control" type="text" value="<?php  echo $row['priority']; ?>" name="priority" disabled="" placeholder="Priority"/>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" type="text" value="<?php  echo $row['issuer_fullname']; ?>" name="user_name" disabled="" placeholder="Name"/>
                </div>
                <div class="form-group">
                  <label>ID</label>
                  <input class="form-control" type="text" value="<?php  echo $row['issuer_id']; ?>" name="user_id" disabled="" placeholder="User ID"/>
                </div>
                <div class="form-group">
                  <label>Department</label>
                  <input class="form-control" type="text" value="<?php  echo $row['department']; ?>" name="department" disabled="" placeholder="Department"/>
                </div>
                <div class="form-group">
                  <label> Status </label>
                  <input class="form-control" type="text" value="<?php  echo $row['ticket_status']; ?>" name="status" disabled="" placeholder="Status"/>
                </div>
                <div class="form-group">
                    <label>Issue Desription</label>
                    <textarea class="form-control" disabled="" placeholder="Your issue goes here..."><?php  echo $row['issue_description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Admin Remarks</label>
                    <textarea class="form-control" disabled="" placeholder="No remark from admin yet..."><?php  echo $row['admin_comment']; ?></textarea>
                </div>
            </div>
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