<?php 
session_start();
require_once("../included/connection.php");
require_once("../included/header.php");
require_once("../included/navigation.php");
$sql = "SELECT count(*) as ppl FROM customer";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql1 = "SELECT count(*) as pro FROM product";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$uid = $_SESSION["ID"];
$sql2 = "SELECT count(*) as trans FROM request WHERE c_id = '$uid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT count(*) as emp FROM users";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);

?>
    <div id="main" class="row">
        <div class="col-2 bluebox">
            <div class="row">
                <div class="col-4 customer mt-2">
                    <label>CLIENTS</label>
                </div>
                <div class="col-8 text-right text-primary mt-2">
                    <i class="fa fa-users fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span><?php echo number_format($row['ppl']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
        <div class="col-2 greenbox">
            <div class="row">
                <div class="col-4 employee mt-2">
                    <label>INVENTORY</label>
                </div>
                <div class="col-8 text-right text-success mt-2">
                    <i class="fa fa-user fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span>0</span> <span>Record(s)</span>
                </div>
            </div>
        </div>
        <div class="col-2 aquabox">
            <div class="row">
                <div class="col-4 product mt-2">
                    <label>PRODUCT</label>
                </div>
                <div class="col-8 text-right text-info mt-2">
                    <i class="fa fa-clipboard fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span><?php echo number_format($row1['pro']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
        <div class="col-2 redbox">
            <div class="row">
                <div class="col-7 supplier mt-2">
                    <labe>ORDER LIST</label>
                </div>
                <div class="col-5 text-right text-danger mt-2">
                    <i class="fa fa-shopping-cart fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span><?php echo number_format($row2['trans']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
    </div>


<?php
require_once("../included/footer.php");
?>