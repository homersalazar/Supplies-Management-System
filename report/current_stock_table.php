<?php 
    $active = "Current Stock Table";
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    require_once("../included/bread.php");
?>
<div id="main">
    <div class="row ml-5">
        <div class="col-11 mt-1">
            <?php 
                $sql= "SELECT * FROM product ORDER BY item_name ASC";
                $result = mysqli_query($conn, $sql) or die( mysqli_error($conn)); 
            ?>
            <div class="row">
                <div class="col-2">
                    <button type="button" class="btn btn-outline-success btn-sm btn-block  mb-2" onclick="exportTableToExcel('stock_table','Item_list')">Export to Excel</button>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-outline-info btn-block fa fa-print"  onclick="print()"> Print</button>
                </div>
            </div>
            <div id="print" class="row">
                <table id="stock_table" class="table table-bordered">
                    <thead class="thead-light pt-2">
                        <th style='width: 20%; text-align:left; padding-left:50px; !important'>Item Name</th>
                        <th style='width: 14%; text-align:center; !important'>Quantity</th>
                        <th style='width: 14%; text-align:center; !important'>Unit</th>
                        <th style='width: 14%; text-align:center; !important'>Color</th>
                        <th style='width: 14%; text-align:center; !important'>Size</th>
                        <th style='width: 20%; text-align:left; !important'>Category</th>
                    </thead>
                    <thead>
                        <?php                                    
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td style='width: 20%; text-align:left; padding-left:50px; !important'>" . $row['item_name'] . "</td>";
                                    echo "<td style='width: 14%; text-align:center; !important'>" . $row['quantity'] . "</td>";
                                    echo "<td style='width: 14%; text-align:center; !important'>" . $row['unit'] . "</td>";
                                    echo "<td style='width: 14%; text-align:center; !important'>" . $row['color'] . "</td>";
                                    echo "<td style='width: 14%; text-align:center; !important'>" . $row['size'] . "</td>";
                                    echo "<td style='width: 20%; text-align:left; !important'>" . $row['category'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    require_once("../included/footer.php");
?>