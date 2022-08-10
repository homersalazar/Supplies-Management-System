<?php
require_once("../included/connection.php");
if(!empty($_POST)){
    $fname= ucwords($_POST["fname"]);  
    $lname = ucwords($_POST["lname"]);  
    $depart = ucwords($_POST["depart"]);  

    $sql = "INSERT INTO customer (fname, lname, depart) VALUES('$fname', '$lname', '$depart')";
    $result = mysqli_query($conn, $sql);
}
?>