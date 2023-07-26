<?php
    require_once("../included/connection.php");
    if(!empty($_POST)){
        $mprQty = $_POST["mprQty"];  
        $mprId = $_POST["mprId"];  
        $sql = "INSERT INTO mpr (mprId, mprQty) 
            VALUES ('$mprId', '$mprQty')";
        $result = mysqli_query($conn, $sql);
    }
?>