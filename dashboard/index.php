<?php 
require_once("../included/connection.php");
require_once("../included/header.php");
require_once("../included/navigation.php");
$sql = "SELECT count(*) as ppl FROM customer";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$sql1 = "SELECT count(*) as pro FROM product";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);

$sql2 = "SELECT count(*) as trans FROM trans";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);

$sql3 = "SELECT count(*) as emp FROM users";
$result3 = mysqli_query($conn, $sql3);
$row3=mysqli_fetch_assoc($result3);

$sql4 = "SELECT count(*) as avail FROM product WHERE quantity > 5";
$result4 = mysqli_query($conn, $sql4);
$row4=mysqli_fetch_assoc($result4);

$sql5 = "SELECT count(*) as low FROM product WHERE quantity <= 5";
$result5 = mysqli_query($conn, $sql5);
$row5=mysqli_fetch_assoc($result5);

$sql6 = "SELECT count(*) as outs FROM product WHERE quantity = 0";
$result6 = mysqli_query($conn, $sql6);
$row6=mysqli_fetch_assoc($result6);

$sql7 = "SELECT count(*) as pre FROM pre_order WHERE status = 'Pending'";
$result7 = mysqli_query($conn, $sql7);
$row7=mysqli_fetch_assoc($result7);
?>
    <div id="main" class="row">
        <div class="col-2 bluebox">
            <div class="row">
                <div class="col-4 customer mt-2">
                    <label>EMPLOYEE</label>
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
                    <label>USERS</label>
                </div>
                <div class="col-8 text-right text-success mt-2">
                    <i class="fa fa-user fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span><?php echo number_format($row3['emp']); ?></span> <span>Record(s)</span>
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
                    <labe>TRANSACTION</label>
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
    <div id="main" class="row">
        <div class="col-2 bluebox">
            <div class="row">
                <div class="col-7 customer mt-2">
                    <label>PRE ORDER</label>
                </div>
                <div class="col-5 text-right text-primary mt-2">
                    <i class="fa fa-users fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span><?php echo number_format($row7['pre']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
        <div class="col-2 greenbox">
            <div class="row">
                <div class="col-4 employee mt-2">
                    <label>AVAILABLE</label>
                </div>
                <div class="col-8 text-right text-success mt-2">
                    <i class="fa fa-user fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                <span><?php echo number_format($row4['avail']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
        <div class="col-2 aquabox">
            <div class="row">
                <div class="col-7 product mt-2">
                    <label>LOW OF STOCK</label>
                </div>
                <div class="col-5 text-right text-info mt-2">
                    <i class="fa fa-clipboard fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                    <span><?php echo number_format($row5['low']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
        <div class="col-2 redbox">
            <div class="row">
                <div class="col-7 supplier mt-2">
                    <labe>OUT OF STOCK</label>
                </div>
                <div class="col-5 text-right text-danger mt-2">
                    <i class="fa fa-shopping-cart fa-2x"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-0 record">
                    <span><?php echo number_format($row6['outs']); ?></span> <span>Record(s)</span>
                </div>
            </div>
        </div>
    </div>
<?php
require_once("../included/footer.php");
?>