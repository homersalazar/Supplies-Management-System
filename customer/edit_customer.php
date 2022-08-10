<?php 
    // session_start();

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
                    <h6>Edit Client</h6>
                </div>
            </div>
            <div class="row">
                <a type="button" class="btn btn-primary btn-block fa fa-reply mt-2 mr-3 ml-3" href="../customer/customer.php"> Back</a>
            </div>
            <form method="POST" action="edit_customer_function.php?id=<?php echo $row['id']; ?>">
                <div class="row mt-3 border border-primary border-top-0 border-right-0 border-left-0 pb-4">
                    <div class="col-3 text-right text-warning mt-3">
                        <label>First Name:</label>
                    </div>
                    <div class="col-9 mt-3">
                        <input type="text" name="fname" id="fname" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['fname']; ?>" required>
                    </div>
                    <div class="col-3 text-right text-warning mt-3">
                        <label>Last Name:</label>
                    </div>
                    <div class="col-9 mt-3">
                        <input type="text" name="lname" id="lname" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['lname']; ?>" required>
                    </div>
                    <div class="col-3 text-right text-warning mt-3">
                        <label>Department:</label>
                    </div>
                    <div class="col-9 mt-3">
                        <select name="depart" id="depart" class="form-control form-control-sm" required>
                            <option selected="true" disabled="disabled">Select Department</option>
                            <option value="0" <?php if ($row['depart'] == "0"): ?> selected="selected"<?php endif; ?>> Accounting Department</option>
                            <option value="1" <?php if ($row['depart'] == "1"): ?> selected="selected"<?php endif; ?>> Finance Department</option>
                            <option value="2" <?php if ($row['depart'] == "2"): ?> selected="selected"<?php endif; ?>> Purchasing Department</option>
                            <option value="3" <?php if ($row['depart'] == "3"): ?> selected="selected"<?php endif; ?>> HR Department</option>
                            <option value="4" <?php if ($row['depart'] == "4"): ?> selected="selected"<?php endif; ?>> IT Department</option>
                            <option value="6" <?php if ($row['depart'] == "6"): ?> selected="selected"<?php endif; ?>> Executive Department</option>
                            <option value="7" <?php if ($row['depart'] == "7"): ?> selected="selected"<?php endif; ?>> Audit Department</option>
                            <option value="5" <?php if ($row['depart'] == "5"): ?> selected="selected"<?php endif; ?>> Pinugay Yard</option>
                        </select>  
                    </div>
                    <div class="col-11 mt-2">
                        <Button type="submit" name="submit" id="submit" class="btn btn-warning btn-block fa fa-edit mr-2 mt-4 ml-4"> Update</Button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    require_once("../included/footer.php");
?>
