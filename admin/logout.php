<?php
session_start();

if(isset($_POST['adminlogout_btn']))
{
    session_destroy();
    unset($_SESSION['email']);
    header('Location: admin-login.php');
}


?>