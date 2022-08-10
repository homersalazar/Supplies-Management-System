<?php
require_once("../included/connection.php");
    $id = $_POST["i_id"];
    if(!empty($_POST)){
        $c_id = $_POST["customer"];  
        $i_id = $_POST["i_id"];  
        $quantities = $_POST["quantities"];        
        $record_date = $_POST["record_date"]; 
        $act = 0;
        $sql = "INSERT INTO trans (c_id, item_id, quantity, request_date, act) 
        VALUES ('$c_id', '$i_id', '$quantities', '$record_date', '$act')";
        $result = mysqli_query($conn, $sql);

        $id = $_POST["i_id"]; 
        $quanties = $_POST["quantities"]; 
        $qty = $_POST["qty"]; 
        $total = (int)$_POST["qty"] - (int)$_POST["quantities"] ; 
        $sql1 = "UPDATE product SET quantity = '$total' WHERE id = '$id' ";
        $result1 = mysqli_query($conn, $sql1);

    }
?>