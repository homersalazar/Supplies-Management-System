<?php  
require_once("../users/auth.php");
require_once("../included/connection.php");
    $id = $_GET['id'];
        if(isset($_POST['submit'])){

            $fname = ucwords($_POST['fname']);
            $lname = ucwords($_POST['lname']);
            $uname = $_POST['uname'];
            $email = $_POST['email'];
            $dept = $_POST['dept'];
            $sql = "UPDATE users SET fname = '$fname', lname = '$lname', dept = '$dept', username = '$uname', email = '$email' WHERE id = '$id' ";
            $conn->query($sql) or die ($conn->error);

            $_SESSION['msg'] = 'Update successfully !';
            if($_SESSION['Access'] == "admin"){
                header("Location: ../dashboard/index.php");
            }else {
                header("Location: ../dashboard/dashboard.php");
            }
            }else{
                echo '<script> alert("User not found!")</script>';
            
            // header("Location: ../employee/employee.php");

}
    ?>