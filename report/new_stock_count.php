<?php 
    $active = "New Stock Transaction";
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    require_once("../included/bread.php");
?>

<div id="main">
    <div class="row ml-5 mt-1">
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            Start Date
                        </div>
                        <div class="col-3">
                            End Date
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-3 mt-2">
                                <input type="date" name="start" id="start" class="form-control form-control-sm" value="<?php echo date('Y-m-d', strtotime(date('Y/m/01'))); ?>" style="width:80%" >
                            </div>
                            <div class="col-3 mt-2">
                                <input type="date" name="end" id="end" class="form-control form-control-sm" value="<?php echo date('Y-m-d', strtotime(date('Y/m/t'))); ?>" style="width:80%">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 mt-2">
                                <button type="submit" name="search" id="search" class="btn btn-primary btn-sm">Generate Report</button>
                                <!-- <button type="submit" name="cart" id="cart" class="btn btn-primary  btn-block fa fa-search"> Search</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>
<div id="main">
    <div class="row ml-5">
        <div class="col-11">
        <?php
            if(isset($_POST['search'])){
            $start = date('Y-m-d',strtotime($_POST['start']));
            $end = date('Y-m-d',strtotime($_POST['end']));                               
            $sql = "SELECT product.item_name, 
            stock.quantity, 
            product.unit, 
            product.size, 
            product.color, 
            stock.date_record as day,
            stock.act AS actions 
            FROM `stock` 
            LEFT JOIN product ON (stock.items_id= product.id)  
            WHERE stock.date_record BETWEEN '$start' AND '$end' 
            ORDER BY stock.date_record , product.item_name ASC";  
            $result = mysqli_query($conn, $sql); 
            $a = "";
            $i = 0;             
            ?>
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-outline-success btn-block btn-sm mt-2" onclick="exportTableToExcel('tblData','New_stock_count')">Export to Excel</button>
                </div>
                <div class="col-2">
                    <!-- <button type="button" class="btn btn-outline-info btn-block fa fa-print mt-2"  onclick="print()"> Print</button> -->
                </div>
            </div>
            <div id="print" class="row">
                <table class="table table-bordered mt-3" id="tblData">
                    <thead>
                        <th>Item Name</th>
                        <th>Total Added</th>
                        <th>Remarks</th>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_array($result)){
                                $day = date('Y-m-d',strtotime($row['day']));
                                $action = $row['actions'];
                                if($action == 0){
                                    $act = "Stock - New";
                                }else{
                                    $act = "Stock - Return";
                                }
                                if($day == $a){
                                    $i--;
                                    $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;
                                    echo "<tr>";
                                        echo "<td>" . $row['item_name'] . " " . $row['size'] . "  " . $color . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>". $act ."</td>";
                                    echo "</tr>";
                                }else{
                                    $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;
                                    $a = date('Y-m-d',strtotime($row['day']));
                                    echo "<tr class='table-primary'>";
                                        echo "<td colspan='3'>" . date('Y-m-d',strtotime($row['day'])) . "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>" . $row['item_name'] . " " . $row['size'] . "  " . $color . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>". $act ."</td>";
                                    echo "</tr>";
                                }
                            }   
                        ?> 
                    </tbody> 
                </table>
            </div>  
        <?php } ?>
    </div>
</div>

<?php 
    require_once("../included/footer.php");
?>