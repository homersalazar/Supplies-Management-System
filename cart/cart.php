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
                    <span><b>Cart</b></span> 
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
                                    $sql = "SELECT product.item_name, stock.quantity, product.unit, product.category, product.size, product.color, stock.date_record as day FROM `stock` 
                                    LEFT JOIN product ON (stock.items_id= product.id)  WHERE stock.date_record BETWEEN '$from' AND '$to' ORDER BY stock.date_record , product.item_name ASC";  
                                    $result = mysqli_query($conn, $sql); 
                                    echo "<table class='table  mt-5'>";
                                        $a = "";
                                        $i = 0;              
                                            echo "<tr>";
                                                echo "<th class='ml-2' style='text-align:left;'>Date</th>";
                                                echo "<th style='text-align:left;'>Item name</th>";
                                                echo "<th>Quantity</th>";
                                                echo "<th>Unit</th>";
                                                echo "<th>Size</th>";
                                                echo "<th>Color</th>";
                                                echo "<th>Category</th>";
                                            echo "<tr>";
                                        while($row = mysqli_fetch_array($result)){
                                            $day = date('Y-m-d',strtotime($row['day']));
                                            if($day == $a){
                                                $i--;
                                                echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td>" . $row['item_name'] . "</td>";
                                                    echo "<td>" . $row['quantity'] . "</td>";
                                                    echo "<td>" . $row['size'] . "</td>";
                                                    echo "<td>" . $row['unit'] . "</td>";
                                                    echo "<td>" . $row['color'] . "</td>";
                                                    echo "<td>" . $row['category'] . "</td>";
                                                echo "</tr>";
                                            }else{
                                                $a = date('Y-m-d',strtotime($row['day']));
                                                echo "<tr>";
                                                    echo "<td>" . date('Y-m-d',strtotime($row['day'])). "</td>";
                                                    echo "<td>" . $row['item_name'] . "</td>";
                                                    echo "<td>" . $row['quantity'] . "</td>";
                                                    echo "<td>" . $row['size'] . "</td>";
                                                    echo "<td>" . $row['unit'] . "</td>";
                                                    echo "<td>" . $row['color'] . "</td>";
                                                    echo "<td>" . $row['category'] . "</td>";
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