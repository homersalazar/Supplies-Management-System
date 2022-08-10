<?php
require_once("../included/connection.php");
if(!empty($_POST)){
    $item_name  = ucwords($_POST["item_name"]);  
    $unit = ucwords($_POST["unit"]);  
    $size = ucwords($_POST["size"]);  
    $category= ucwords($_POST["category"]);  
    $color = ucwords($_POST["color"]);  
    $quantity = "0";  

    $sql = "INSERT INTO product (item_name, quantity, unit, size, category, color) VALUES('$item_name', ' $quantity', '$unit', '$size', '$category', '$color')";
    $result = mysqli_query($conn, $sql);
}
?>