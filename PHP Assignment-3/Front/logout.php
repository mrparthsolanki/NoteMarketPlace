<?php  include "include/header.php"; ?>
<?php
    
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_role_id']);
    unset($_SESSION['user_first_name']);
    unset($_SESSION['user_last_name']);
    unset($_SESSION['user_email_id']);

    
    redirect("login.php");
    
?>