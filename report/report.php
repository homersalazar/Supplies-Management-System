<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    
    $sql = "SELECT * FROM customer";  
    $result = mysqli_query($conn, $sql);  

    if(isset($_SESSION['msg'])){ ?>
        <div class="alert alert-success middle" role="alert">
            <button type="button" class="close" data-dismiss="alert"> x</button>
            <strong><?php echo $_SESSION['msg'] ?></strong>
        </div>
        <?php unset($_SESSION['msg']);
    }
    $cart = "";
    $search = "";
    $filter = "";
  
    if(isset($_POST['search']) ){
        $search = "active";
        $search1 = "show active";
    }else if(isset($_POST['filter']) ){
        $filter = "active";
        $filter1 = "show active";
    }else{
       $cart = "active";      
    }
?>
<div id="main">
    <div class="row ml-5 mt-4">
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    <span><b>Report</b></span> 
                    <!-- <span><button type="button" class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#customer"></button></span> -->
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo $cart ?>" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="true">Purchase</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo $search ?>" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Supplies Request</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo $filter ?>" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Inventory</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show <?php echo $cart ?>" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                            <form method="POST" action="" > 
                                <div class="row mt-3">
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
                                        <button type="submit" name="cart" id="cart" class="btn btn-primary  btn-block fa fa-search"> Search</button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-info btn-block fa fa-print"  onclick="printCart()"> Print</button>
                                    </div>
                                </div>                            
                            </form>
                            <div id="CART" class="row">     
                                <?php
                                    if(isset($_POST['cart'])){
                                        $from = date('Y-m-d',strtotime($_POST['from']));
                                        $to = date('Y-m-d',strtotime($_POST['to']));                               
                                        $sql = "SELECT product.item_name, stock.quantity, product.unit, product.category, product.size, product.color, stock.date_record as days FROM `stock` 
                                        LEFT JOIN product ON (stock.items_id= product.id)  WHERE stock.dates BETWEEN '$from' AND '$to' ORDER BY days ASC";  
                                        $result = mysqli_query($conn, $sql); 
                                            $a = "";
                                            $i = 0;
                                        ?>
                                        <table class="table table-bordered mt-5">
                                            <thead>
                                                <th style='width: 14%; text-align:center; !important'>Date</th>
                                                <th style='width: 14%; text-align:left; !important'>Item name</th>
                                                <th style='width: 14%; text-align:center; !important'>Quantity</th>
                                                <th style='width: 14%; text-align:left; !important'>Unit</th>
                                                <th style='width: 12%; text-align:left; !important'>Size</th>
                                                <th style='width: 12%; text-align:left; !important'>Color</th>
                                                <th style='width: 14%; text-align:left; !important'>Category</th>
                                            </thead>
                                            <?php
                                            while($row = mysqli_fetch_array($result)){
                                                $day = date('Y-m-d',strtotime($row['days']));
                                                if($day == $a){
                                                    $i--;                               
                                                    echo "<tr>";
                                                        echo "<td style='width: 14%; text-align:center; !important'></td>";
                                                        echo "<td style='width: 18%; text-align:left; !important'>" . $row['item_name'] . "</td>";
                                                        echo "<td style='width: 14%; text-align:center; !important'>" . $row['quantity'] . "</td>";
                                                        echo "<td style='width: 14%; text-align:left; !important'>" . $row['unit'] . "</td>";
                                                        echo "<td style='width: 12%; text-align:left; !important'>" . $row['size'] . "</td>";
                                                        echo "<td style='width: 12%; text-align:left; !important'>" . $row['color'] . "</td>";
                                                        echo "<td style='width: 14%; text-align:left; !important'>" . $row['category'] . "</td>";
                                                    echo "</tr>";
                                                }else{
                                                    $a = date('Y-m-d',strtotime($row['days']));
                                                    echo "<tr>";
                                                        echo "<td style='width: 14%; text-align:center;  !important'>" . date('Y-m-d',strtotime($row['days'])). "</td>";
                                                        echo "<td style='width: 18`%; text-align:left; !important'>" . $row['item_name'] . "</td>";
                                                        echo "<td style='width: 14%; text-align:center; !important'>" . $row['quantity'] . "</td>";
                                                        echo "<td style='width: 14%; text-align:left; !important'>" . $row['unit'] . "</td>";
                                                        echo "<td style='width: 12%; text-align:left; !important'>" . $row['size'] . "</td>";
                                                        echo "<td style='width: 12%; text-align:left; !important'>" . $row['color'] . "</td>";
                                                        echo "<td style='width: 16%; text-align:left; !important'>" . $row['category'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            }    
                                        echo "</table>";  
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php echo $search1; ?>" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <form method="POST" action="" > 
                                <div class="row mt-4">
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
                                        <button type="submit" name="search" id="search" class="btn btn-primary  btn-block fa fa-search"> Search</button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-info btn-block fa fa-print"  onclick="printDiv()"> Print</button>
                                    </div>
                                </div>
                            </form>
                            <div id="GFG" class="row">     
                                <?php
                                    if(isset($_POST['search'])){
                                        $from = date('Y-m-d',strtotime($_POST['from']));
                                        $to = date('Y-m-d',strtotime($_POST['to']));   
                                        // $sql = "SELECT customer.fname, customer.lname, customer.depart, product.item_name, transaction.quantity, product.unit, product.size, product.color, transaction.request_date AS dates FROM `transaction`
                                        // LEFT JOIN product ON (transaction.item_id= product.id)  
                                        // LEFT JOIN customer ON (transaction.c_id= customer.id)
                                        // WHERE transaction.request_date BETWEEN '$from' AND '$to'"; 
                                        $sql = "SELECT customer.fname, customer.lname, customer.depart, product.item_name, transaction.quantity, product.unit, product.size, product.color, transaction.request_date AS date1 FROM `transaction`
                                        LEFT JOIN product ON (transaction.item_id= product.id)  
                                        LEFT JOIN customer ON (transaction.c_id= customer.id)
                                        WHERE transaction.request_date BETWEEN '$from' AND '$to' ORDER BY date1 ASC"; 
                                        $result = mysqli_query($conn, $sql); 
                                            $a = "";
                                            $i = 0;
                                        ?>                       
                                        <table class="table table-bordered mt-5">
                                            <thead>
                                                <th style='width: 11%; text-align:center; !important'>Date</th>
                                                <th style='width: 16%; text-align:left; !important'>Employee Name</th>
                                                <th style='width: 22%; text-align:left; !important'>Department</th>
                                                <th style='width: 15%; text-align:left; !important'>Item name</th> 
                                                <th style='width: 9%; text-align:center; !important'>Quantity</th>
                                                <th style='width: 9%; text-align:left; !important'>Unit</th>  
                                                <th style='width: 9%; text-align:left; !important'>Size</th>                                                 
                                                <th style='width: 9%; text-align:left; !important'>Color</th>                                                
                                            </thead>
                                            <?php  
                                            while($row = mysqli_fetch_array($result)){
                                                $department = $row['depart'];
                                                $day = $row['date1'];
                                                $dis_result = "";

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
                                                    }elseif($department == 7){
                                                        $dis_result = "Audit Department";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td style='width: 11%; text-align:center; !important'></td>";
                                                    echo "<td style='width: 16%; text-align:left; !important'>" . $row['fname'] . " ". $row['lname'] . "</td>";
                                                    echo "<td style='width: 22%; text-align:left; !important'>" . $dis_result . "</td>";
                                                    echo "<td style='width: 15%; text-align:left; !important'>" . $row['item_name'] . "</td>";
                                                    echo "<td style='width: 9%; text-align:center; !important'>" . $row['quantity'] . "</td>";
                                                    echo "<td style='width: 9%; text-align:left; !important'>" . $row['unit'] . "</td>";
                                                    echo "<td style='width: 9%; text-align:left; !important'>" . $row['size'] . "</td>";
                                                    echo "<td style='width: 9%; text-align:left; !important'>" . $row['color'] . "</td>";
                                                echo "</tr>";
                                                }else{
      
                                                    $a = date('Y-m-d',strtotime($row['date1'])); 
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
                                                    // $a = $row['date1'];
                                                    echo "<tr>";
                                                        echo "<td style='width: 11%; text-align:center; !important'>" . date('Y-m-d',strtotime($row['date1'])). "</td>";
                                                        echo "<td style='width: 16%; text-align:left; !important'>" . $row['fname'] ."  ". $row['lname'] . "</td>";
                                                        echo "<td style='width: 22%; text-align:left; !important'>" . $dis_result . "</td>";
                                                        echo "<td style='width: 15%; text-align:left; !important'>" . $row['item_name'] . "</td>";
                                                        echo "<td style='width: 9%; text-align:center; !important'>" . $row['quantity'] . "</td>";
                                                        echo "<td style='width: 9%; text-align:left; !important'>" . $row['unit'] . "</td>";
                                                        echo "<td style='width: 9%; text-align:left; !important'>" . $row['size'] . "</td>";
                                                        echo "<td style='width: 9%; text-align:left; !important'>" . $row['color'] . "</td>";
                                                    echo "</tr>";
                                                }    
                                            }    
                                        echo "</table>";  
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php echo $filter1 ?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row mt-3">
                                <div class="col-3">
                                    <?php 
                                        $sql= "SELECT * FROM product ORDER BY item_name ASC";
                                        $result = mysqli_query($conn, $sql) or die( mysqli_error($conn)); 
                                        if(ISSET($_POST['filter'])){
                                            $statistic=$_POST['statistic']; 
                                            if($statistic == 1){
                                                $sql= "SELECT * FROM product WHERE quantity != 0 ORDER BY item_name ASC";
                                                $result = mysqli_query($conn, $sql)  or die( mysqli_error($conn)); 
                                            }else if($statistic == 2){
                                                $sql= "SELECT * FROM product WHERE quantity < 5 AND quantity != 0  ORDER BY item_name ASC";
                                                $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));  
                                            }else if($statistic == 3){
                                                $sql= "SELECT * FROM product WHERE quantity = 0 ORDER BY item_name ASC";
                                                $result = mysqli_query($conn, $sql) or die( mysqli_error($conn)); 
                                            }
                                        }
                                    ?>
                                    <form method="POST" action="">
                                        <div class="form-inline">
                                            <select class="form-control form-control-sm" name="statistic">
                                                <option value="">Select Status</option>
                                                <option value="1">Available</option>
                                                <option value="2">Low Stock</option>
                                                <option value="3">Out of Stock</option>
                                            </select>&nbsp;
                                            <button class="btn btn-primary btn-sm" name="filter">Filter</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-info btn-block fa fa-print"  onclick="printTabs()"> Print</button>
                                </div>
                            </div>
                            <div id="TABS" class="row mt-2">
                                <table class="table table-bordered">
                                    <thead class="thead-light pt-2">
                                    <!-- echo "<tr>"; -->
                                        <th style='width: 20%; text-align:left; padding-left:50px; !important'>Item Name</th>
                                        <th style='width: 14%; text-align:center; !important'>Quantity</th>
                                        <th style='width: 14%; text-align:center; !important'>Unit</th>
                                        <th style='width: 14%; text-align:center; !important'>Color</th>
                                        <th style='width: 14%; text-align:center; !important'>Size</th>
                                        <th style='width: 20%; text-align:left; !important'>Category</th>
                                    <!-- echo "<tr>"; -->

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
            </div>
        </div>
    </div>  
    <script type="text/javascript">
        function printCart() {
            var divContents = document.getElementById("CART").innerHTML;
            var a = window.open('', '', 'height=650, width=900');
            a.document.write('<html>');
            a.document.write('<head> <br> <h3 style="text-align:center;">GLOBAL HEAVY EQUIPMENT AND CONSTRUCTION CORP. <br> <h4 style="text-align:center; text-decoration: underline;">Summary Report <br>');
            a.document.write('<body> <h3 asdas <br><br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.focus();
            a.print();
            a.close();
            return false;
        }
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=650, width=900');
            a.document.write('<html>');
            a.document.write('<head> <h3 style="text-align:center; margin-top:5px;"> <br>GLOBAL HEAVY EQUIPMENT AND CONSTRUCTION CORP. <br> <h4 style="text-align:center; text-decoration: underline;">Summary Report <br>');
            a.document.write('<body> <h3 asdas <br><br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.focus(); // necessary for IE >= 10*/
            a.print();
            a.close();
            return false;
        }
        function printTabs() {
            var divContents = document.getElementById("TABS").innerHTML;
            var a = window.open('', '', 'height=650, width=900');
            a.document.write('<html>');
            a.document.write('<head> <h3 style="text-align:center;"> <br>GLOBAL HEAVY EQUIPMENT AND CONSTRUCTION CORP. <br> <h4 style="text-align:center; text-decoration: underline;">Summary Report <br>');
            a.document.write('<body> <h3 asdas <br><br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.focus(); // necessary for IE >= 10*/
            a.print();
            a.close();
            return false;
        }

    </script>
<?php
    require_once("../included/footer.php");
?>
