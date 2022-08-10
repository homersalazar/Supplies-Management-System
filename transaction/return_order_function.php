<?php
require_once("../included/connection.php");
    $id = $_POST["r_id"];
    if(!empty($_POST)){
        $c_id = $_POST["cus"];  
        // $i_id = $_POST["r_id"];  
        $quantity = $_POST["qty"];        
        $record_date = $_POST["r_date"]; 
        $act = 1;
        $sql = "INSERT INTO trans (c_id, item_id, quantity, request_date, act) VALUES ('$c_id', '$id', '$quantity', '$record_date', '$act')";
        $result = mysqli_query($conn, $sql);

        // $id = $_POST["r_id"]; 
        $quanties = $_POST["quan"]; 
        $qty = $_POST["qty"]; 
        $total = (int)$_POST["qty"] + (int)$_POST["quan"] ; 
        $sql1 = "UPDATE product SET quantity = '$total' WHERE id = '$id' ";
        $result1 = mysqli_query($conn, $sql1);

        $act = 1;
        // $items_id = $_POST["r_id"];  
        $quantities = $_POST["qty"]; 
        $add_date = $_POST["r_date"]; 
        $sql2 = "INSERT INTO stock (items_id, quantity, date_record, act) VALUES ('$id' , '$quantities' , '$add_date' , '$act')";
        $result2 = mysqli_query($conn, $sql2);

    }
?>