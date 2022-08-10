<?php
require_once("../included/connection.php");
    $id = $_POST["pre_id1"];
    if(!empty($_POST)){
        $status = "Cancelled";
        $sql = "UPDATE pre_order SET status = '$status' WHERE id = '$id' ";
        $result = mysqli_query($conn, $sql);
    }
?>