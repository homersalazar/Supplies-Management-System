<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");

?>  
<div id="main">

<div class="row">    
    <div class="container">             
        <?php 
            $sql = "SELECT customer.fname, customer.lname, customer.depart, product.item_name, transaction.quantity, product.unit, product.size, product.color, transaction.request_date AS date1 FROM `transaction`
            LEFT JOIN product ON (transaction.item_id= product.id) 
            LEFT JOIN customer ON (transaction.c_id= customer.id) 
            WHERE transaction.request_date BETWEEN '2022-4-20' AND '2022-6-16' ORDER BY  depart ASC"; 
            $result = mysqli_query($conn, $sql); 
                echo "<table class='table  mt-5'>";
                    $a = "";
                    $i = 0;                       
                        echo "<tr>";
                            echo "<th>Date</th>";
                            echo "<th>Department</th>";
                            echo "<th>Item name</th>";
                            echo "<th>Quantity</th>";
     
                            echo "<th>Color</th>";
                        echo "<tr>";  
                    while($row = mysqli_fetch_array($result)){
                        $department = $row['depart'];
                        $day = $row['date1'];
                        $size = !empty($row["size"])  ? "- ".$row["size"] : "" ;

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
                                echo "<td>" . $dis_result . "</td>";
                                echo "<td>" . $row['item_name'] . "  " . $size . "</td>";
                                echo "<td>" . $row['quantity'] . " " . $row['unit'] . "</td>";
                                echo "<td>" . $row['color'] . "</td>";
                            echo "</tr>";
                        }else{
                            $size = !empty($row["size"])  ? "- ".$row["size"] : "" ;

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
                                echo "<td>" . $dis_result . "</td>";
                                echo "<td>" . $row['item_name'] . "  " . $size . "</td>";
                                echo "<td>" . $row['quantity'] . " " . $row['unit'] . "</td>";
                                echo "<td>" . $row['color'] . "</td>";
                            echo "</tr>";
                        }
                    }    
                echo "</table>";  
        ?>
    </div>
</div>


<?php
require_once("../included/footer.php");
?>