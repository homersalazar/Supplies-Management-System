<?php 
    $active = "MPR Request";
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    require_once("../included/bread.php");

    $sql = "SELECT *
    FROM mpr m
    LEFT JOIN product p ON p.id = m.mprId";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn)); 
?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            border: 1px solid black;
            padding: 8px;
        }   

        td {
            border-left: 1px solid black;
            border-right: 1px solid black;
            padding: 8px;

        }

        tbody{
            border-bottom: 1px solid black;
        }

        .items{
            text-align: center;
        }
        .right{
            text-align: right;
        }

        .top{
            border-top: 1px solid black;
        }
        .width{
            width: 20%;
        }
        /* Add any other styles as needed for the table */
    </style>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn btn-outline-success btn-sm btn-block  mb-2" onclick="exportTableToExcel('stock_table','Item_list')">Export to Excel</button>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-info btn-block fa fa-print"  onclick="print_mpr()"> Print</button>
            </div>
        </div>
        <section id="print_mpr">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>DATE:</th>
                                <td colspan="4" class="top"><?= date("Y-m-d") ?></td>
                            </tr>
                            <tr>
                                <th style="width: 25%">PROJECT SITE:</th>
                                <td colspan="4" class="top">Main Office</td>
                            </tr>
                            <tr>
                                <th width="20%">ITEM #</th>
                                <th width="50%">DESCRIPTION</th>
                                <th class="items" width="20%">ALU NO.</th>
                                <th class="items" width="10%">QTY</th>
                                <th class="items" width="10%">UNIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                while($row = mysqli_fetch_array($result)){ 
                            ?>                     
                                <tr>
                                    <td class="text-center items"><?=$count; ?></td>
                                    <td><?= $row['color'] . ' ' . $row['item_name'] . ' ' . $row['size']; ?></td>
                                    <td class="border"><?= $row['item_code'] ?></td>
                                    <td class="items"><?= $row['mprQty'] ?></td>
                                    <td><?= $row['unit'] ?></td>
                                </tr>
                            <?php 
                                $count++;
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
<?php 
    require_once("../included/footer.php");
?>