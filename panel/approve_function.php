<?php
require_once("../included/connection.php");
    $id = $_POST["supply_id"];
    if(!empty($_POST)){
        $client_id = $_POST["client_id_id"];  
        $supply_id = $_POST["supply_id"];
        $qtys = $_POST["qtys"];
        $status = "Approved";
        $record_date = date("Y-m-d"); 
        $sql = "INSERT INTO approved (c_id, item_id, quantity, status, request_date) VALUES ('$client_id', '$supply_id', '$qtys', '$status', '$record_date')";
        $result = mysqli_query($conn, $sql);

        $id = $_POST["supply_id"];
        $status = "Approved";
        $sql1 = "UPDATE request SET status = '$status' WHERE id = '$id' ";
        $result1 = mysqli_query($conn, $sql1);

        $client_id = $_POST["client_id_id"];  
        $supply_id = $_POST["supply_id"];
        $qtys = $_POST["qtys"];
        $record_date = date("Y-m-d"); 
        $sql2 = "INSERT INTO approved (c_id, item_id, quantity, request_date) VALUES ('$client_id', '$supply_id', '$qtys', '$record_date')";
        $result2 = mysqli_query($conn, $sql2);

        $id = $_POST["supply_id"];
        $p_qty= $_POST["p_qty"];
        $r_qty = $_POST["r_qty"];
        $total = (int)$_POST["p_qty"] - (int)$_POST["r_qty"] ; 
        $sql3 = "UPDATE request SET status = '$total' WHERE id = '$id' ";
        $result3 = mysqli_query($conn, $sql3);
    }
?>