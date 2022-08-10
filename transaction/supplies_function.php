<?php
require_once("../users/auth.php");
require_once("../included/connection.php");
    $id = $_POST["t_id"];
    $c_id = $_SESSION['ID'];
    $status = "Pending";

    if(!empty($_POST)){

        $t_id = $_POST["t_id"];  
        $quanties = $_POST["quantities"]; 
        $sql = "INSERT INTO request (c_id, item_id, quantity , status) VALUES ('$c_id', '$t_id', '$quanties', '$status')";
        $result = mysqli_query($conn, $sql);
    }
?>