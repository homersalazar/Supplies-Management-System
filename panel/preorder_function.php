<?php
require_once("../included/connection.php");
    $id = $_POST["p_id"];
    if(!empty($_POST)){
        $c_id = $_POST["c_id"];  
        $id = $_POST["p_id"];  
        $qty = $_POST["qty"];        
        $record_date = date("Y-m-d"); 
        $act = 0;
        $sql = "INSERT INTO trans (c_id, item_id, quantity, request_date, act) 
        VALUES ('$c_id', '$id', '$qty', '$record_date', '$act')";
        $result = mysqli_query($conn, $sql);

        // $id = $_POST["p_id"]; 
        $quantities = $_POST["quantities"]; 
        $qty = $_POST["qty"]; 
        $total = (int)$_POST["quantities"] - (int)$_POST["qty"] ; 
        $sql1 = "UPDATE product SET quantity = '$total' WHERE id = '$id' ";
        $result1 = mysqli_query($conn, $sql1);
        
        $id = $_POST["pre_id"]; 
        $status = "Approved";
        $sql2 = "UPDATE pre_order SET status = '$status' WHERE id = '$id' ";
        $result2 = mysqli_query($conn, $sql2);
    }
?>