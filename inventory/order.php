<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    
    // $sql = "SELECT * FROM customer";  
    // $result = mysqli_query($conn, $sql);  

    if(isset($_SESSION['msg'])){ ?>
        <div class="alert alert-success middle" role="alert">
            <button type="button" class="close" data-dismiss="alert"> x</button>
            <strong><?php echo $_SESSION['msg'] ?></strong>
        </div>
        <?php unset($_SESSION['msg']);
    }
?>
<div id="main">
    <div class="row ml-5 mt-4">
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    <span><b>Order List</b></span> 
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="true">Supplies Request</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Approved</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php
                            $uid = $_SESSION["ID"];
                            $sql = "SELECT  product.item_name, request.quantity, product.unit, product.size, product.color, product.category, request.dates as day FROM `request`
                            LEFT JOIN product ON (request.item_id= product.id) 
                            LEFT JOIN customer ON (request.c_id= customer.id) WHERE request.c_id = '$uid'"; 
                            $result = mysqli_query($conn, $sql); 
                        ?>
                        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                            <div class="p-3">
                                <table id="order_table" class="table table-bordered mt-5">
                                    <thead class="thead-light">
                                        <tr>
                                        <th width="15%">Item Name</th>
                                        <th width="11%">Quantity</th>
                                        <th width="11%">Size</th>
                                        <th width="11%">Unit</th>
                                        <th width="11%">Color</th>
                                        <th width="15%">Category</th>
                                        <th width="11%">Date</th>
                                        <th width="12%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  while($row = mysqli_fetch_array($result)){ ?>  
                                            <tr>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['size']; ?></td>
                                                <td><?php echo $row['unit']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td><?php echo $row['category']; ?></td>
                                                <td><?php echo date('Y-m-d',strtotime($row['day']));?></td>
                                                <td>
                                                    <small><div class="btn-group">
                                                        <a type="button" class="btn btn-danger btn-sm fa fa-list fa-xs" href="#" > Details</a>
                                                        <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                            <span class="sr-only">...</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right   ">
                                                            <a class="dropdown-item pt-2 <?php echo $request ?>" onclick="request_function('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>' )">Request</a>
                                                        </div>
                                                    </div></small> 
                                                </td>
                                            </tr>
                                        <?php  }   ?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <?php
                                $sql1 = "SELECT users.fname, users.lname, product.item_name, approved.quantity as qty, product.unit, product.size, product.color, approved.status as stats, approved.record_date FROM `approved` 
                                LEFT JOIN product ON (approved.item_id = product.id) 
                                LEFT JOIN users ON (approved.c_id = users.id)";
                                $result = mysqli_query($conn, $sql1); 
                            ?>
                            <div class="p-3">
                                <table id="approved_table" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="15%">Item Name</th>
                                            <th width="11%">Quantity</th>
                                            <th width="11%">Size</th>
                                            <th width="11%">Unit</th>
                                            <th width="11%">Color</th>
                                            <th width="15%">Status</th>
                                            <th width="11%">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  while($row = mysqli_fetch_array($result)){ ?>  
                                            <tr>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['qty']; ?></td>
                                                <td><?php echo $row['size']; ?></td>
                                                <td><?php echo $row['unit']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td><?php echo $row['stats']; ?></td>
                                                <td><?php echo $row['record_date']; ?></td>
                                            </tr>      
                                        <?php  }   ?>         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <script>
        $(document).ready(function() {
            $('#order_table').DataTable();
            $('#approved_table').DataTable();
        });
    </script>
<?php
    require_once("../included/footer.php");
?>
