<?php
include('security-2.php');
include('includes/header.php'); 
include('includes/navbar-2.php'); 
?>



<div class="modal fade" id="addticketprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="newcode.php" method="POST">

        <div class="modal-body">
            <div class="form-group"> 
                <!-- <label> Issue Date </label> -->
                <input class="form-control" type="hidden" name="ticket_date" value="<?php echo date("Y-m-d"); ?>" placeholder="MM/DD/YYY"/>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label> Full name </label>
                  <input type="text" name="issuer_fullname" class="form-control" placeholder="Enter Full name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>ID</label>
                  <input type="text" name="issuer_id" class="form-control" placeholder="Enter ID" required>
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
                  <label>Priority</label>
                  <select class="select form-control" name="priority" required>
                    <option value="" disabled selected>Choose Priority</option>
                    <option value="Low">Low</option>
                    <option value="High">High</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Issue Description</label>
              <textarea name="issue_description" class="form-control" placeholder="Describe your issue here..." required></textarea>
            </div>
            <div class="form-group">
                <!-- User Email, Ticket Status & Admin Comment -->
                <input type="hidden" name="user_email" class="form-control" value="<?php echo $_SESSION['email']; ?>" placeholder="Enter Officer Email">
                <input type="hidden" name="ticket_status" class="form-control" value="Pending">
                <input type="hidden" name="admin_comment" class="form-control" value="No remarks yet.">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="ticket_registerbtn" class="btn btn-primary">Send</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      
    </div>
  </div>
</div>


<div class="container-fluid">

<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
  <div class="mr-4 mb-3 mb-sm-0">
      <h1 class="mb-0 text-gray-800">Report Issues</h1>
      <div class="small"><span class="font-weight-500" id="ct"></span></div>
  </div>         
</div>

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">History 
        <button type="button" class="btn btn-primary" name="addticketbtn" data-toggle="modal" data-target="#addticketprofile">
            Add Issue 
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
        $user = $_SESSION['email'];

        $query = "SELECT * FROM ticket_table WHERE user_email='$user'";
        $query_run = mysqli_query($conn, $query);
        
    ?>

      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="d-none">ID</th>
            <th>Issue Date</th>
            <th>Issue Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Admin Remarks</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
              $var = $row['ticket_status'];
              $original_date = $row['issue_date'];
              $timestamp = strtotime($original_date);
               ?>
          <tr>
            <td class="d-none"><?php  echo $row['id']; ?></td>
            <td><?php  echo date("d-m-Y", $timestamp); ?></td>
            <td><?php  echo $row['issue_description']; ?></td>
            <td><?php  echo $row['priority']; ?></td>
            <td style="color:<?=($var=="Reviewing")?'#2689b2':(($var=="Closed")?'#1cc88a':'#f6c23e')?>"><?php echo $row['ticket_status']; ?></td>
            <td><?php  echo $row['admin_comment']; ?></td>
            <td>
              <form action="view_request.php" method="post">
                  <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                  <button  type="submit" name="requestbtn" class="btn"><i class="fas fa-eye text-info"></i></button>
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