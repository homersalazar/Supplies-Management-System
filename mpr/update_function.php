<?php
    require_once("../included/connection.php");
    if(!empty($_POST)){
        $mprQty = $_POST["mprQty"];  
        $mprId = $_POST["mprId"];  
        $sql = "UPDATE mpr
            SET mprQty = '$mprQty'
            WHERE id = '$mprId'"; 
        $result = mysqli_query($conn, $sql);
    }
?>