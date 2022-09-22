<?php

include('security.php');

$connection = mysqli_connect("HOST_NAME","DB_USERNAME","DB_PASSWORD","DB_NAME");

//Admin CRUD
if(isset($_POST['admin_registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM admin_table WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: add-admin.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO admin_table (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin added";
                $_SESSION['status_code'] = "success";
                header('Location: add-admin.php');
            }
            else 
            {
                $_SESSION['status'] = "Error adding admin";
                $_SESSION['status_code'] = "error";
                header('Location: add-admin.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Passwords Do Not Match!";
            $_SESSION['status_code'] = "warning";
            header('Location: add-admin.php');  
        }
    }

}


if(isset($_POST['admin_updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE admin_table SET username='$username', email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data updated";
        $_SESSION['status_code'] = "success";
        header('Location: add-admin.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Updating Data";
        $_SESSION['status_code'] = "error";
        header('Location: add-admin.php'); 
    }
}


if(isset($_POST['admin_deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM admin_table WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data deleted";
        $_SESSION['status_code'] = "success";
        header('Location: add-admin.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Deleting Data";       
        $_SESSION['status_code'] = "error";
        header('Location: add-admin.php'); 
    }    
}

//Logs in Admin
if(isset($_POST['adminlogin_btn']))
{
    $email_loginadmin = $_POST['admin_email']; 
    $password_loginadmin = $_POST['admin_password']; 

    $query = "SELECT * FROM admin_table WHERE email='$email_loginadmin' AND password='$password_loginadmin' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['email'] = $email_loginadmin;
        header('Location: admin-dashboard.php');
   } 
   else
   {
        $_SESSION['status'] = "Invalid email or password";
        header('Location: admin-login.php');
   }
    
}


//User CRUD
if(isset($_POST['user_registerbtn']))
{
    $user_fullname = $_POST['user_fullname'];  
    $user_gender = $_POST['user_gender'];
    $department = $_POST['department'];
    $date = $_POST['account_validity'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $c_password = $_POST['confirm_password'];

    if($user_password === $c_password)
    {
        $query = "INSERT INTO user_table (fullname,gender,department,account_validity,email,password) VALUES ('$user_fullname','$user_gender','$department','$date','$user_email','$user_password')";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            // echo "Saved";
            $_SESSION['status'] = "User profile added";
            $_SESSION['status_code'] = "success";
            header('Location: add-user.php');
        }
        else 
        {
            $_SESSION['status'] = "User Profile NOT Added";
            $_SESSION['status_code'] = "error";
            header('Location: add-user.php');  
        }
    }
    else 
    {
        $_SESSION['status'] = "Passwords Do Not Match";
        $_SESSION['status_code'] = "warning";
        header('Location: add-user.php');  
    }
    


}

if(isset($_POST['user_updatebtn']))
{
    $id = $_POST['edit_id'];
    $user_fullname = $_POST['edit_user_fullname'];
    $user_gender = $_POST['edit_user_gender'];
    $user_department = $_POST['edit_user_department'];
    $date = $_POST['edit_account_validity'];        
    $user_email = $_POST['edit_user_email'];
    $user_password = $_POST['edit_user_password'];
    $query = "UPDATE user_table SET fullname='$user_fullname', gender='$user_gender', department='$user_department', account_validity='$date', email='$user_email', password='$user_password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data updated";
        $_SESSION['status_code'] = "success";
        header('Location: add-user.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Updating Data";
        $_SESSION['status_code'] = "error";
        header('Location: add-user.php'); 
    }
}

if(isset($_POST['user_deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM user_table WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data deleted";
        $_SESSION['status_code'] = "success";
        header('Location: add-user.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Deleting Data";       
        $_SESSION['status_code'] = "error";
        header('Location: add-user.php'); 
    }    
}

//Update ticket Table
if(isset($_POST['ticket_updatebtn']))
{
    $id = $_POST['edit_id'];
    $status = $_POST['edit_ticket_status'];
    $comment = mysqli_real_escape_string($connection, $_POST['edit_admin_comment']);    

    $query = "UPDATE ticket_table SET ticket_status='$status', admin_comment='$comment' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data updated";
        $_SESSION['status_code'] = "success";
        header('Location: tickets.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Updating Data";
        $_SESSION['status_code'] = "error";
        header('Location: tickets.php'); 
    }
}

if(isset($_POST['ticket_deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM ticket_table WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data deleted";
        $_SESSION['status_code'] = "success";
        header('Location: tickets.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Deleting Data";       
        $_SESSION['status_code'] = "error";
        header('Location: tickets.php'); 
    }    
}

//Send Notification
if(isset($_POST['notify_btn']))
{
    $notify_date = $_POST['notification_date'];
    $notification_description = mysqli_real_escape_string($connection, $_POST['notify_description']);
    $sender = $_POST['admin_name'];

    $query = "INSERT INTO notifications (date_sent, notification_content, sender_name) VALUES ('$notify_date', '$notification_description', '$sender')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Notifcation Sent!";
        $_SESSION['status_code'] = "success";
        header('Location: notification.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error sending notification";       
        $_SESSION['status_code'] = "error";
        header('Location: notification.php'); 
    }    
}

//Delete Notification
if(isset($_POST['notification_deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM notifications WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Notification deleted";
        $_SESSION['status_code'] = "success";
        header('Location: notification.php'); 
    }
    else
    {
        $_SESSION['status'] = "Error Deleting Notification";       
        $_SESSION['status_code'] = "error";
        header('Location: notification.php'); 
    }    
}

?>