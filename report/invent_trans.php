<?php 
    $active = "Inventory Transaction";
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
                            Department:
                        </div>
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
                                <select name="dep" id="dep" class="form-control form-control-sm" >
                                    <option value="" disabled selected>Select Department</option>
                                    <?php $sql1 ="SELECT * FROM department ORDER BY depart ASC";
                                        $result1 = mysqli_query($conn, $sql1);  
                                        while($row1 = mysqli_fetch_array($result1)){ ?>
                                    <option value="<?php echo $row1['depart_num']; ?>"><?php echo $row1['depart']; ?> </option>
                                    <?php } ?>
                                </select>    
                            </div>
                            <div class="col-3 mt-2">
                                <!-- <input type="date" name="start" id="start" class="form-control form-control-sm" style="width:80%"> -->
                                <input type="date" name="start" id="start" class="form-control form-control-sm"  value="<?php echo date('Y-m-d', strtotime(date('Y/m/01'))); ?>" style="width:80%" >
                            </div>
                            <div class="col-3 mt-2">
                                <!-- <input type="date" name="end" id="end" class="form-control form-control-sm" style="width:80%"> -->
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
                // $dept = $_POST['dep'];
                $start = date('Y-m-d',strtotime($_POST['start']));
                $end = date('Y-m-d',strtotime($_POST['end']));                               
                $sql = "SELECT request_date AS days, 
                department.depart AS departs, 
                product.item_name, 
                product.unit, 
                product.size, 
                product.color,
                -- (SELECT item_id,SUM(quantity) as qty FROM transaction )
                SUM(trans.quantity) AS qty
                -- transaction.quantity AS qty

                FROM `trans` 

                LEFT JOIN customer ON (trans.c_id = customer.id)

                LEFT JOIN department ON (customer.depart = department.depart_num)

                LEFT JOIN product ON (trans.item_id = product.id) 

                WHERE trans.request_date 
                
                -- AND 
                                    
                BETWEEN '$start' AND '$end'

                GROUP BY trans.item_id, departs

                ORDER BY departs, product.item_name ASC
                
                "; 

                $result = mysqli_query($conn, $sql); 
                $a = "";
                $i = 0;
                ?>
                <div class="row mt-2">
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-success btn-block btn-sm" onclick="exportTableToExcel('tbltran','Inventory_transaction')">Export to Excel</button>
                    </div>
                    <div class="col-2">
                    <button type="button" class="btn btn-outline-info btn-block fa fa-print"  onclick="print()"> Print</button>
                    </div>
                </div>
                <div id="print" class="row">
                    <table id="tbltran" class="table table-bordered mt-3">
                        <thead>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                        </thead>
                        <?php
                        while($row = mysqli_fetch_array($result)){
                            $day = date('Y-m-d',strtotime($row['days']));
                            $day1 = $row['departs'];
                            if($day1 == $a){
                                $i--;
                                $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;

                                echo "<tr>";
                                    echo "<td>" . $row['item_name'] . " " . $row['size'] . "  " . $color . "</td>";
                                    echo "<td>" . $row['qty'] . "</td>";
                                    echo "<td>" . $row['unit'] . "</td>";
                                echo "</tr>";
                            }else{
                                $a = $row['departs'];
                                $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;

                                echo "<tr class='table-primary'>";
                                    echo "<td colspan=5>" . $row['departs'] . "</b></td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>" . $row['item_name'] . " " . $row['size'] . "  " . $color . "</td>";
                                    echo "<td>" . $row['qty'] . "</td>";
                                    echo "<td>" . $row['unit'] . "</td>";
                                echo "</tr>";
                            }
                        }  ?>
                    </table>
                </div>  
            <?php } ?>
        </div>
    </div>
</div>

<?php 
    require_once("../included/footer.php");
?>