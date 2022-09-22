<?php


include('security-2.php');

$conn = mysqli_connect("HOST_NAME","DB_USERNAME","DB_PASSWORD","DB_NAME");


//User Login
if(isset($_POST['userlogin_btn']))
{
    $email_loginuser = $_POST['user_email']; 
    $password_loginuser = $_POST['user_password']; 

    $query = "SELECT * FROM user_table WHERE email='$email_loginuser' AND password='$password_loginuser' LIMIT 1";
    $query_run = mysqli_query($conn, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['email'] = $email_loginuser;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Invalid email or password";
        header('Location: login.php');
   }
    
}

//User CRUD
if(isset($_POST['ticket_registerbtn']))
{
    
    $fullname = $_POST['issuer_fullname'];
    $id = $_POST['issuer_id'];
    $email = $_POST['user_email'];
    $issuer_department = $_POST['department'];
    $description = mysqli_real_escape_string($conn, $_POST['issue_description']);
    $issue_priority = $_POST['priority'];
    $status = $_POST['ticket_status'];
    $comment = $_POST['admin_comment'];
    $date = $_POST['ticket_date'];

     $query = "INSERT INTO ticket_table (issuer_fullname,issuer_id,user_email,department,issue_description,priority,ticket_status,admin_comment,issue_date) VALUES ('$fullname','$id','$email','$issuer_department','$description','$issue_priority','$status','$comment','$date')";
     $query_run = mysqli_query($conn, $query);
     
     if($query_run)
     {
          // echo "Saved";
          $_SESSION['status'] = "Request Sent!";
          $_SESSION['status_code'] = "success";
          header('Location: add-ticket.php');
     }
     else 
     {
          $_SESSION['status'] = "Failed to Send Request!";
          $_SESSION['status_code'] = "error";
          header('Location: add-ticket.php');  
     }
    
}

 ?>