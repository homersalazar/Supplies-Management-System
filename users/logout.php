<?php
    session_start();
    // Destroy session
    unset($_SESSION['Userlogin']);
    unset($_SESSION['Access']);
    echo header("Location: ../users/login.php");
    
?>