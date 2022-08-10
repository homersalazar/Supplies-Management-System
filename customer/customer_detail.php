<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");

    $id = $_GET['id'];
    $sql = "SELECT * FROM customer WHERE id ='$id'";  
    $result = mysqli_query($conn, $sql);  
    $row = $result->fetch_assoc();



?>
    <div id="detail">
        <div class="container bg-white">
            <div class="row ">
                <div class="col-12 text-primary text-center mt-4">
                    <h6>Client's Detail</h6>
                </div>
            </div>
            <div class="row">
                <a type="button" class="btn btn-primary btn-block fa fa-reply mt-2 mr-3 ml-3" href="../customer/customer.php"> Back</a>
            </div>
            <div class="row mt-3 border border-primary border-top-0 border-right-0 border-left-0 pb-4">
                <div class="col-3 text-right text-primary mt-2">
                    <label>Full Name:</label>
                </div>
                <div class="col-9 mt-2">
                    <span><?php echo $row["fname"]; ?></span> <span><?php echo $row["lname"]; ?></span>
                </div>
                <div class="col-3 text-right text-primary mt-2">
                    <label>Department:</label>
                </div>
                <div class="col-9 mt-2">
                    <span><?php
                        $department = $row["depart"];
                        if($department == 0){
                            echo "Accounting Department";
                        }elseif($department == 1){
                            echo "Finance Department";
                        }elseif($department == 2){
                            echo "Purchasing Department";
                        }elseif($department == 3){
                            echo "Hr Department";
                        }elseif($department == 4){
                            echo "IT Department";
                        }elseif($department == 5){
                            echo "Pinugay Yard";
                        }elseif($department == 6){
                            echo "Executive Department";
                        }elseif($department == 7){
                            echo "Audit Department";
                        }       
                    ?></span>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once("../included/footer.php");
?>