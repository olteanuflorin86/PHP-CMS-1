<?php session_start(); ?>

<?php 

    /*
    $_SESSION['username'] = NULL;
    $_SESSION['user_firstname'] = NULL;
    $_SESSION['user_lastname'] = NULL;
    $_SESSION['user_role'] = NULL;
    */

    
    unset($_SESSION['username']); 
    unset($_SESSION['user_firstname']); 
    unset($_SESSION['user_lastname']); 
    unset($_SESSION['user_role']); 
    
    
    header("Location: ../index.php");
    
?>