<?php
require_once("../included/connection.php");
    $id = $_POST["t_id"];
    if(!empty($_POST)){
        $c_id = $_POST["customer"];  
        $t_id = $_POST["t_id"];  
        $quanties = $_POST["quantities"];        
        $record_date = $_POST["record_date"]; 
        $status = "Pending"; 

        $sql = "INSERT INTO pre_order (c_id, item_id, quantity, request_date, status) VALUES ('$c_id', '$t_id', '$quanties', '$record_date' , '$status')";
        $result = mysqli_query($conn, $sql);

    }
?>