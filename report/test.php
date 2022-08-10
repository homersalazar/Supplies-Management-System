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
                    echo "<tr>";
                        echo "<th>Date</th>";
                        echo "<th>Department</th>";
                        echo "<th>Item name</th>";
                        echo "<th>Quantity</th>";
                        echo "<th>Color</th>";
                    echo "<tr>";  
                    while($row = mysqli_fetch_array($result)){     
                        echo "<tr>";
                            echo "<td></td>";
                            // echo "<td>"  "</td>";
                            echo "<td>" . $row['item_name'] .  "</td>";
                            echo "<td>" . $row['quantity'] .  "</td>";
                            echo "<td>" . $row['color'] . "</td>";
                        echo "</tr>";
                    }
                echo "</table>";  
            ?>
        </div>
    </div>
<?php 
    require_once("../included/footer.php");
?>  