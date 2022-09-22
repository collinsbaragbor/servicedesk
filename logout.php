<?php
session_start();


if(isset($_POST['userlogout_btn']))
{
    session_destroy();
    unset($_SESSION['email']);
    header('Location: login.php');
}

?>