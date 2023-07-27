<?php
    require_once("../included/connection.php");
    if(isset($_POST['submit'])){
        $sql = "DELETE FROM mpr";
        $result = mysqli_query($conn, $sql);
    }
?>