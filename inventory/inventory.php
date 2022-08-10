<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");

?>  
<div id="main">
    <div class="row ml-5 mt-4">
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    <span><b>Order List</b></span> 
                </div>
                <div class="card-body">
                    <form method="POST" action="" > 
                        <div class="row">
                            <div class="col-1 text-right">
                                <label>FROM:</label>
                            </div>
                            <div class="col-2">
                                <input type="date" name="from" id="from" class="form-control form-control-sm" >
                            </div>
                            <div class="col-1 text-right">
                                <label>TO:</label>
                            </div>
                            <div class="col-2">
                                <input type="date" name="to" id="to"  class="form-control form-control-sm" >
                            </div>
                            <div class="col-2">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary  btn-block fa fa-search"> Search</button>
                            </div>
                        </div>
                        <div class="row">                        
                            <?php
                                if(isset($_POST['submit'])){
                                    $from = date('Y-m-d',strtotime($_POST['from']));
                                    $to = date('Y-m-d',strtotime($_POST['to']));   
                                    // $sql = "SELECT customer.fname, customer.lname, customer.depart, product.item_name, transaction.quantity, product.unit, product.size, product.color, transaction.request_date FROM `transaction`
                                    // LEFT JOIN product ON (transaction.item_id= product.id)  
                                    // LEFT JOIN customer ON (transaction.c_id= customer.id)
                                    // WHERE transaction.request_date BETWEEN '$from' AND '$to'"; 
                                    $sql = "SELECT customer.fname, customer.lname, customer.depart, product.item_name, transaction.quantity, product.unit, product.size, product.color, transaction.request_date AS date1 FROM `transaction`
                                    LEFT JOIN product ON (transaction.item_id= product.id)  
                                    LEFT JOIN customer ON (transaction.c_id= customer.id)
                                    WHERE transaction.request_date BETWEEN '2022-4-20' AND '2022-6-16' ORDER BY date1 ASC"; 
                                    $result = mysqli_query($conn, $sql); 
                                    echo "<table class='table  mt-5'>";
                                        $a = "";
                                        $i = 0;                       
                                            echo "<tr>";
                                                echo "<th>Date</th>";
                                                echo "<th>Employee Name</th>";
                                                echo "<th>Department</th>";
                                                echo "<th>Item name</th>";
                                                echo "<th>Quantity</th>";
                                                echo "<th>Unit</th>";
                                                echo "<th>Size</th>";
                                                echo "<th>Color</th>";
                                            echo "<tr>";  
                                        while($row = mysqli_fetch_array($result)){
                                            $department = $row['depart'];
                                            // $day = date('Y-m-d',strtotime($row['dates']));
                                            $day = $row['date1'];

                                            if($day == $a){
                                                $i--;
                                                if($department == 0){
                                                    $dis_result = "Accounting Department";
                                                }elseif($department == 1){
                                                    $dis_result = "Finance Department";
                                                }elseif($department == 2){
                                                    $dis_result = "Purchasing Department";
                                                }elseif($department == 3){
                                                    $dis_result = "Hr Department";
                                                }elseif($department == 4){
                                                    $dis_result = "IT Department";
                                                }elseif($department == 5){
                                                    $dis_result = "Pinugay Yard";
                                                }elseif($department == 6){
                                                    $dis_result = "Executive Department";
                                                } elseif($department == 7){
                                                    $dis_result = "Audit Department";
                                                }        
                                                echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td>" . $row['fname'] . " ". $row['lname'] . "</td>";
                                                    echo "<td>" . $dis_result . "</td>";
                                                    echo "<td>" . $row['item_name'] . "</td>";
                                                    echo "<td>" . $row['quantity'] . "</td>";
                                                    echo "<td>" . $row['unit'] . "</td>";
                                                    echo "<td>" . $row['size'] . "</td>";
                                                    echo "<td>" . $row['color'] . "</td>";
                                                echo "</tr>";
                                            }else{
                                                if($department == 0){
                                                    $dis_result = "Accounting Department";
                                                }elseif($department == 1){
                                                    $dis_result = "Finance Department";
                                                }elseif($department == 2){
                                                    $dis_result = "Purchasing Department";
                                                }elseif($department == 3){
                                                    $dis_result = "Hr Department";
                                                }elseif($department == 4){
                                                    $dis_result = "IT Department";
                                                }elseif($department == 5){
                                                    $dis_result = "Pinugay Yard";
                                                }elseif($department == 6){
                                                    $dis_result = "Executive Department";
                                                }elseif($department == 7){
                                                    $dis_result = "Audit Department";
                                                }   
                                                $a = $row['date1'];
                                                echo "<tr>";
                                                    echo "<td>" .  $row['date1']. "</td>";
                                                    echo "<td>" . $row['fname'] ."  ". $row['lname'] . "</td>";
                                                    echo "<td>" . $dis_result . "</td>";
                                                    echo "<td>" . $row['item_name'] . "</td>";
                                                    echo "<td>" . $row['quantity'] . "</td>";
                                                    echo "<td>" . $row['unit'] . "</td>";
                                                    echo "<td>" . $row['size'] . "</td>";
                                                    echo "<td>" . $row['color'] . "</td>";
                                                echo "</tr>";
                                            }
                                        }    
                                    echo "</table>";  
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>  

<?php
require_once("../included/footer.php");
?>