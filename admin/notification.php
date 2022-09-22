<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<div class="container-fluid">

<div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
  <div class="mr-4 mb-3 mb-sm-0">
      <h1 class="mb-0 text-gray-800">Notifications</h1>
      <div class="small"><span class="font-weight-500" id="ct"></span></div>
  </div>         
</div>

<!-- DataTable -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">All Notifications 
    </h6>
  </div>

  <div class="card-body">
    <?php
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
      echo '<h5> '.$_SESSION['success'].' </h5>';
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

        $query = "SELECT * FROM notifications";
        $query_run = mysqli_query($connection, $query);
        
    ?>

      <table class="table table-bordered table-hover" id="dataTableSort" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="d-none">ID</th>
            <th>Date Sent</th>
            <th>Content</th>
            <th>Sender</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
          
            while($row = mysqli_fetch_assoc($query_run))
            {
              $original_date = $row['date_sent'];
              $timestamp = strtotime($original_date);
               ?>
          <tr>
            <td class="d-none"><?php  echo $row['id']; ?></td>
            <td><?php  echo date("d-m-Y", $timestamp); ?></td>
            <td><?php  echo $row['notification_content']; ?></td>
            <td><?php  echo $row['sender_name']; ?></td>
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="notification_deletebtn" class="btn"> <i class="fas fa-trash text-danger"></i></button>
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