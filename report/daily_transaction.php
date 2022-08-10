<?php 
    $active = "Daily Transaction";
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
                                <input type="date" name="start" id="start" class="form-control form-control-sm" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" style="width:80%" >
                            </div>
                            <div class="col-3 mt-2">
                                <input type="date"  name="end" id="end" class="form-control form-control-sm" style="display:none" value="<?php echo date('Y-m-d', strtotime(date('Y/m/d'))); ?>" style="width:80%">
                                <input type="checkbox" id="myCheck"  onclick="myFunction()" checked>
                                <label for="myCheck"> same day</label> 
                            </div>
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                            <div class="col-2 mt-2">
                                <button type="submit" name="search" id="search" class="btn btn-primary btn-sm">Generate Report</button>
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
            // $sql = "SELECT product.item_name, 
            // stock.quantity, 
            // product.unit, 
            // product.size, 
            // product.color, 
            // stock.date_record as day 
            // FROM `stock` 
            // LEFT JOIN product ON (stock.items_id= product.id)  
            // WHERE stock.date_record BETWEEN '$start' AND '$end' 
            // ORDER BY stock.date_record , product.item_name ASC";  
            $sql = "SELECT request_date AS days, 
            department.depart AS departs, 
            product.item_name, 
            product.unit, 
            product.size, 
            product.color,
            SUM(trans.quantity) AS qty,
            trans.act AS actions
            FROM `trans` 
            LEFT JOIN customer ON (trans.c_id = customer.id)
            LEFT JOIN department ON (customer.depart = department.depart_num)
            LEFT JOIN product ON (trans.item_id = product.id) 
            WHERE trans.request_date                              
            BETWEEN '$start' AND '$end'
            GROUP BY trans.item_id, departs, trans.act
            ORDER BY departs, product.item_name ASC
            "; 
            $result = mysqli_query($conn, $sql); 
            $a = "";
            $i = 0;             
            ?>
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-outline-success btn-block btn-sm mt-2" onclick="exportTableToExcel('tblData','New_stock_count')">Export to Excel</button>
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
                                $day = date('Y-m-d',strtotime($row['days']));
                                $day1 = $row['departs'];
                                $act = "";
                                $action = $row['actions'];
                                if($action == 0){
                                    $act = "Stock - Out";
                                }else{
                                    $act = "Stock - Return";
                                }
                                if($day == $a){
                                    $i--;
                                    $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;
                                    echo "<tr>";
                                        echo "<td>" . $row['item_name'] . " " . $row['size'] . "  " . $color . "</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
                                        echo "<td>". $act ."</td>";
                                    echo "</tr>";
                                }else{
                                    $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;
                                    $a = date('Y-m-d',strtotime($row['days']));
                                    echo "<tr class='table-primary'>";
                                        echo "<td colspan='3'>" . date('Y-m-d',strtotime($row['days'])) . "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>" . $row['item_name'] . " " . $row['size'] . "  " . $color . "</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
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
<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("end");
  if (checkBox.checked == true){
    // text.style.display = "block";
         text.style.display = "none";

  } else {
    //  text.style.display = "none";
    text.style.display = "block";

  }
}
</script>

<?php 
    require_once("../included/footer.php");
?>