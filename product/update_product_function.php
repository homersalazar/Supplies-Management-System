<?php  
    require_once("../users/auth.php");
    require_once("../included/connection.php");
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
        $item_name  = ucwords($_POST["item_name"]);  
        $unit = ucwords($_POST["unit"]);  
        $size = ucwords($_POST["size"]);  
        $category= ucwords($_POST["category"]);  
        $color = ucwords($_POST["color"]);  
        $remarks = $_POST['disc'];
        $sql = "UPDATE product SET item_name = '$item_name', unit = '$unit', size = '$size', category = '$category', color = '$color', description = '$remarks' WHERE id = '$id' ";
        $conn->query($sql) or die ($conn->error);
        $_SESSION['msg'] = 'Update successfully !';
        header("Location: ../product/product.php"); 
    }
    ?>