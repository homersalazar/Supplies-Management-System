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
                    <span><b>Report</b></span> 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <a href="invent_trans.php" type="button" class="btn btn-primary bwidths fa fa-th"> Inventory Transaction</a>
                        </div>
                        <div class="col-2 ml-4">
                            <a href="daily_transaction.php" type="button" class="btn btn-primary bwidths fa fa-calendar"> Daily Transaction</a>
                        </div>
                        <div class="col-2 ml-4">
                            <a href="new_stock_count.php" type="button" class="btn btn-primary  bwidths fa fa-list-ol"> New Stock Counts</a>
                        </div>
                        <div class="col-2 ml-4">
                            <a href="current_stock_table.php" type="button" class="btn btn-primary bwidths fa fa-table"> Current Stock Table</a>
                        </div>
                        <div class="col-2 ml-4">
                            <a href="current_stock_list.php" type="button" class="btn btn-primary bwidths fa fa-list-ul"> Current Stock List</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2">
                            <a href="low_stock_list.php" type="button" class="btn btn-primary bwidths fa fa-align-left"> Low Stock List</a>
                        </div>
                        <div class="col-2 ml-4">
                            <a href="out_stock_list.php" type="button" class="btn btn-primary bwidths fa fa-align-center"> Out Of Stock List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
    require_once("../included/footer.php");
?>