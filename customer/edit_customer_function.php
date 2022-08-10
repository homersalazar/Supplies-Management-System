<?php  
require_once("../users/auth.php");
require_once("../included/connection.php");
    $id = $_GET['id'];
        if(isset($_POST['submit'])){

            $fname = ucwords($_POST['fname']);
            $lname = ucwords($_POST['lname']);
            $depart = $_POST['depart'];
            $sql = "UPDATE customer SET fname = '$fname', lname = '$lname', depart = '$depart' WHERE id = '$id' ";
            $conn->query($sql) or die ($conn->error);

            $_SESSION['msg'] = 'Update successfully !';
            header("Location: ../customer/customer.php");

}
    ?>