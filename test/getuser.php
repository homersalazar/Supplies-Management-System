
<?php
require_once("../included/connection.php");
    if(ISSET($_POST['filter'])){
        $statistic=$_POST['statistic']; 
        if($statistic == 1){
            $sql= "SELECT * FROM product WHERE quantity > '5'";
            $result = mysqli_query($conn, $sql)  or die( mysqli_error($conn)); 
        }else if($statistic == 2){
            $sql= "SELECT * FROM product WHERE quantity <= '5'";
            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));  
        }else if($statistic == 3){
            $sql= "SELECT * FROM product WHERE quantity = '0'";
            $result = mysqli_query($conn, $sql) or die( mysqli_error($conn)); 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    </head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        </div>
    </nav>
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <h3 class="text-primary">PHP - Drop Down Filter Selection</h3>
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" action="">
                <div class="form-inline">
                    <label>Category:</label>
                    <select class="form-control" name="statistic">
                        <option value="">Show All</option>
                        <option value="1">Available</option>
                        <option value="2">Low Stock</option>
                        <option value="3">Out of Stock</option>
                    </select>
                    <button class="btn btn-primary" name="filter">Filter</button>
                </div>
            </form>
            <br /><br />
            <table class="table table-bordered">
                <thead class="alert-info">
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Category</th>
                </thead>
                <thead>
                    <?php                                    
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td>" . $row['item_name'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['unit'] . "</td>";
                                echo "<td>" . $row['color'] . "</td>";
                                echo "<td>" . $row['size'] . "</td>";
                                echo "<td>" . $row['category'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </thead>
            </table>
        </div>
    </div>
</body>	
</html>