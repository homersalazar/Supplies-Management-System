<?php 
require_once("../included/connection.php");

if(!empty($_POST)){
    $items_id = $_POST['items_id'];
    $quantity = $_POST['quantity'];
    $quantitys = $_POST['quantitys'];
    $totals = (int)$_POST['quantitys'] + (int)$_POST['quantity'];
    $sql1 = "UPDATE product SET quantity = '$totals' WHERE id = '$items_id' ";
    $result1 = mysqli_query($conn, $sql1);

    $act = 0;
    $items_id = $_POST["items_id"];  
    $quantities = $_POST["quantity"]; 
    $add_date = $_POST["add_date"]; 
    $sql = "INSERT INTO stock (items_id, quantity, date_record, act) VALUES ('$items_id' , '$quantities' , '$add_date' , '$act')";
    $result = mysqli_query($conn, $sql);
}
?>