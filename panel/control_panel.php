<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    
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
                    <span><b>Control Panel</b></span> 
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
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Pre Order</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php
                            $sql = "SELECT product.id as pro_id, 
                            users.id as u_id, 
                            users.fname, 
                            users.lname, 
                            product.quantity as p_qty, 
                            product.item_name, 
                            request.quantity as r_qty, 
                            product.unit, 
                            product.size, 
                            product.color, 
                            request.status, 
                            request.dates as day 
                            FROM `request` 
                            LEFT JOIN product ON (request.item_id= product.id) 
                            LEFT JOIN users ON (request.c_id= users.id) "; 
                            $result = mysqli_query($conn, $sql); 
                        ?>
                        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                            <div class="p-3">
                                <table id="order_table" class="table table-bordered mt-5">
                                    <thead class="thead-light">
                                        <tr>
                                        <th width="19%">Employee Name</th>
                                        <th width="14%">Item Name</th>
                                        <th width="6%">Quantity</th>
                                        <th width="11%">Size</th>
                                        <th width="11%">Unit</th>
                                        <th width="11%">Color</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Request Date</th>
                                        <th width="12%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  while($row = mysqli_fetch_array($result)){ 
                                            $r_qty = $row['r_qty'];
                                            $p_qty = $row['p_qty'];

                                            if($p_qty < $r_qty){
                                                $approved = "disabled";
                                            }else{
                                                $approved ="";
                                            }
                                            ?>  
                                            <tr>
                                                <td width="19%"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </td>
                                                <td width="14%"><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['r_qty']; ?></td>
                                                <td><?php echo $row['size']; ?></td>
                                                <td><?php echo $row['unit']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td width="14%"><?php echo date('Y-m-d',strtotime($row['day']));?></td>
                                                <td width="12%">
                                                    <small><div class="btn-group">
                                                        <a type="button" class="btn btn-success btn-sm fa fa-list fa-xs" href="#" > Details</a>
                                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                            <span class="sr-only">...</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right   ">
                                                            <a class="dropdown-item pt-2 <?php echo $approved ?>" onclick="approved_function('<?php echo $row['pro_id']; ?>' , '<?php echo $row['u_id']; ?>' , '<?php echo $row['p_qty']; ?>' , '<?php echo $row['fname']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['r_qty']; ?>' )">Approved</a>
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
                                $sql3 = "SELECT users.fname, users.lname, product.item_name, approved.quantity as a_qty, product.unit, product.size, product.color, approved.status, approved.record_date, approved.dates as day FROM `approved` 
                                LEFT JOIN product ON (approved.item_id= product.id) 
                                LEFT JOIN users ON (approved.c_id= users.id)"; 
                                $result3 = mysqli_query($conn, $sql3); 
                            ?>
                            <div class="mt-3">
                                <table id="approved_table" class="table table-bordered mt-5">
                                    <thead class="thead-light">
                                        <tr>
                                        <th width="20%">Employee Name</th>
                                        <th width="20%">Item Name</th>
                                        <th width="6%">Quantity</th>
                                        <th width="12%">Size</th>
                                        <th width="12%">Unit</th>
                                        <th width="12%">Color</th>
                                        <th width="12%">Status</th>
                                        <th width="15%">Approved Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  while($row = mysqli_fetch_array($result3)){ ?>  
                                            <tr>
                                                <td width="16%"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </td>
                                                <td width="15%"><?php echo $row['item_name']; ?></td>
                                                <td width="6%"><?php echo $row['a_qty']; ?></td>
                                                <td><?php echo $row['size']; ?></td>
                                                <td><?php echo $row['unit']; ?></td>
                                                <td><?php echo $row['color']; ?></td>   
                                                <td width="10%"><?php echo $row['status']; ?></td>   
                                                <td width="15%"><?php echo date('Y-m-d',strtotime($row['day']));?></td>              
                                            </tr>
                                        <?php  }   ?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <?php
                            $sql1 = "SELECT product.id as p_id, 
                            pre_order.id as pre_id, 
                            customer.id as c_id,
                            customer.fname, 
                            customer.lname, 
                            customer.depart, 
                            product.item_name as iname, 
                            pre_order.quantity, 
                            product.unit, 
                            product.size, 
                            product.color, 
                            pre_order.request_date as day , 
                            pre_order.quantity as qty, 
                            product.quantity as quantities, 
                            pre_order.status as stats  
                            FROM `pre_order`
                            LEFT JOIN product ON (pre_order.item_id= product.id)  
                            LEFT JOIN customer ON (pre_order.c_id= customer.id)
                            WHERE pre_order.request_date AND pre_order.status = 'Pending'"; 
                            $result1 = mysqli_query($conn, $sql1); 
                        ?>
                        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <select id="statusFilter" class="form-control form-control-sm">
                                        <option value="">Show All</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="p-3">
                                <table id="pre_order_table" class="table table-bordered mt-5">
                                    <thead class="thead-light">
                                        <tr>
                                        <th style="width:20px;">Employee Name</th>
                                        <th style="width:20px;">Item Name</th>
                                        <th width="3%">Quantity</th>
                                        <th width="10%">Size</th>
                                        <th width="10%">Unit</th>
                                        <th width="10%">Color</th>
                                        <th width="7%">Status</th>
                                        <th width="11%">Date</th>
                                        <th width="9%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  while($row = mysqli_fetch_array($result1)){ 
                                            $quantities = $row['quantities'];
                                            $qty = $row['qty'];
                                            $stats = $row['stats'];
                                            $cancel = "";

                                            if($quantities < $qty){
                                                $approved = "disabled";
                                            }else{
                                                $approved ="";
                                            }
                                            
                                            if($stats != "Cancelled"){
                                                echo '';
                                            }else{
                                                $cancel = "disabled";
                                            }
                                            ?>  
                                            <tr>
                                                <td width="16%"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </td>
                                                <td width="15%"><?php echo $row['iname']; ?></td>
                                                <td width="3%"><?php echo $row['qty']; ?></td>
                                                <td><?php echo $row['size']; ?></td>
                                                <td><?php echo $row['unit']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td width="7%"><?php echo $row['stats']; ?></td>
                                                <td width="11%"><?php echo date('Y-m-d',strtotime($row['day']));?></td>
                                                <td width="12%">
                                                    <small><div class="btn-group">
                                                        <a type="button" class="btn btn-danger btn-sm fa fa-list fa-xs" onclick="detail_function('<?php echo $row['pre_id'] ?>' , '<?php echo $row['fname'] ?>' , '<?php echo $row['iname'] ?>' , '<?php echo $row['qty'] ?>' , '<?php echo $row['size'] ?>' , '<?php echo $row['unit'] ?>' , '<?php echo $row['color'] ?>' , '<?php echo $row['stats'] ?>')"> Details</a>
                                                        <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                            <span class="sr-only">...</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right   ">
                                                            <a class="dropdown-item pt-2 <?php echo $approved ?>" onclick="request_function('<?php echo $row['pre_id'] ?>', '<?php echo $row['p_id'] ?>' , '<?php echo $row['c_id'] ?>' , '<?php echo $row['qty'] ?>' , '<?php echo $row['fname'] ?>' , '<?php echo $row['iname'] ?>' , '<?php echo $row['quantity'] ?>' , '<?php echo $row['size'] ?>' , '<?php echo $row['unit'] ?>' , '<?php echo $row['color'] ?>')">Request</a>
                                                            <a class="dropdown-item pt-2 <?php echo $cancel ?>" onclick="cancel_function('<?php echo $row['pre_id'] ?>' , '<?php echo $row['c_id'] ?>' , '<?php echo $row['fname'] ?>' , '<?php echo $row['iname'] ?>' , '<?php echo $row['qty'] ?>')">Cancel</a>
                                                        </div>
                                                    </div></small> 
                                                </td>
                                            </tr>
                                        <?php  }   ?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Approved Modal -->
<div class="modal fade" id="approved" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Approve Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="approval_form" method="POST"> 
                    <div class="row">
                        <div class="col-4 text-right">
                            <label for="">Employee Name:</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="ename" id="ename" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Item Name:</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="iname" id="iname" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Quantity:</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="qtys" id="qtys" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="client_id" id="client_id" class="form-control form-control-sm" readonly>
                    <input type="hidden" name="supply_id" id="supply_id" class="form-control form-control-sm" readonly>
                    <input type="hidden" name="p_qty" id="p_qty" class="form-control form-control-sm" readonly>
                    <input type="button" class="btn btn-success btn-sm" name="approve" id="approve" value="Submit">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>  
    <!-- Pre Order modal -->
<div class="modal fade" id="pre_order" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pre Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                
        <form method="POST" id="preorder_form">
            <div class="row" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-3 text-right">
                    <label for="">Employee Name</label>
                </div>
                <div class="col-9">
                    <input type="text" name="cname" id="cname" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-3 text-right">
                    <label for="">Item Name</label>
                </div>
                <div class="col-9">
                    <input type="text" name="itname" id="itname" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-3 text-right">
                    <label for="">Quantity</label>
                </div>
                <div class="col-9">
                    <input type="text" name="qty" id="qty" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-3 text-right">
                    <label for="">Size</label>
                </div>
                <div class="col-9">
                    <input type="text" name="size" id="size" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-3 text-right">
                    <label for="">Unit</label>
                </div>
                <div class="col-9">
                    <input type="text" name="unit" id="unit" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                <div class="col-3 text-right">
                    <label for="">Color</label>
                </div>
                <div class="col-9">
                    <input type="text" name="color" id="color" class="form-control form-control-sm" readonly>
                    <input type="text" id="quantities" name="quantities">

                </div>
            </div>
        </div>
      <div class="modal-footer">
        <input type="text" id="p_id" name="p_id">
        <input type="hidden" id="c_id" name="c_id">
        <input type="hidden" id="pre_id" name="pre_id">
        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm ">Submit</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </form>

    </div>
  </div>
</div>
    <!--PreOrder - Cancel Modal -->
<div class="modal fade" id="cancel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cancellation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="cancels_form">
                    <div class="row" style="font-family: 'Times New Roman', Times, serif;">
                        <div class="col-3 text-right">
                            <label for="">Client Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="clients_name" id="clients_name" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                        <div class="col-3 text-right">
                            <label for="">Item Name</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="supply_name" id="supply_name" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2" style="font-family: 'Times New Roman', Times, serif;">
                        <div class="col-3 text-right">
                            <label for="">Quantity</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="num" id="num" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pre_id1" id="pre_id1" class="form-control form-control-sm" readonly>
                    <input type="hidden" name="client_ids" id="client_ids" class="form-control form-control-sm" readonly>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm ">Submit</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!--PreOrder - View Modal -->
<div class="modal fade" id="details" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pre Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-4 text-right">
                            <label for="">Employee Name:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="employ" id="employ" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Item Name:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="supply" id="supply" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Quantity:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="quan" id="quan" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Size:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="sized" id="sized" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Unit:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="units" id="units" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Color:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="colored" id="colored" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-right">
                            <label for="">Status:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="stats" id="stats" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="ids" id="ids" class="form-control form-control-sm" readonly>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <script>
        function detail_function(ids , employ , supply , quan , sized , units , colored , stats){
            $('#details').modal('show');
            document.getElementById("ids").value = ids;
            document.getElementById("employ").value = employ;
            document.getElementById("supply").value = supply;
            document.getElementById("quan").value = quan;
            document.getElementById("sized").value = sized;
            document.getElementById("units").value = units;
            document.getElementById("colored").value = colored;
            document.getElementById("stats").value = stats;
        }
        function cancel_function(pre_id1 , client_ids, clients_name , supply_name , num){
            $('#cancel').modal('show');
            document.getElementById("pre_id1").value = pre_id1;
            document.getElementById("client_ids").value = client_ids;
            document.getElementById("clients_name").value = clients_name;
            document.getElementById("supply_name").value = supply_name;
            document.getElementById("num").value = num;
            $('#cancels_form').on("submit", function(event){ 
                $.ajax({  
                    url:"cancel_function.php",  
                    method:"POST",  
                    data:$('#cancels_form').serialize(),  
                    success:function(data){  
                        $('#cancels_form')[0].reset();  
                        $('#cancel').modal('hide');  
                        $('#pre_order_table').html(data);  
                        window.location.reload();
                    }  
                });                  
            });  
        }
        function approved_function(supply_id, client_id, p_qty, ename, iname, qtys){
            $('#approved').modal('show');
            document.getElementById("supply_id").value = supply_id;
            document.getElementById("client_id").value = client_id;
            document.getElementById("p_qty").value = p_qty;
            document.getElementById("ename").value = ename;
            document.getElementById("iname").value = iname;
            document.getElementById("qtys").value = qtys;
            $('#approval_form').on("submit", function(event){ 
                $.ajax({  
                    url:"approve_function.php",  
                    method:"POST",  
                    data:$('#approval_form').serialize(),  
                    success:function(data){  
                        $('#approval_form')[0].reset();  
                        $('#approved').modal('hide');  
                        $('#order_table').html(data);  
                        window.location.reload();
                    }  
                });                  
            }); 
        }
        function request_function(pre_id , p_id , c_id, quantities, cname, itname , qty , size , unit , color){
            $('#pre_order').modal('show');
            document.getElementById("pre_id").value = pre_id;
            document.getElementById("p_id").value = p_id;
            document.getElementById("c_id").value = c_id;
            document.getElementById("quantities").value = quantities;
            document.getElementById("cname").value = cname;
            document.getElementById("itname").value = itname;
            document.getElementById("qty").value = qty;
            document.getElementById("size").value = size;
            document.getElementById("unit").value = unit;
            document.getElementById("color").value = color;
            $('#preorder_form').on("submit", function(event){ 
                $.ajax({  
                    url:"preorder_function.php",  
                    method:"POST",  
                    data:$('#preorder_form').serialize(),  
                    success:function(data){  
                        // $('#preorder_form')[0].reset();  
                        // $('#pre_order').modal('hide');  
                        // $('#pre_order_table').html(data);  
                        // window.location.reload();
                    }  
                });                  
            });  
        }
        $(document).ready(function() {
            $('#order_table').DataTable();
            $('#approved_table').DataTable();
            var table = $('#pre_order_table').DataTable();
        
            var categoryIndex = 0;
            $("#pre_order_table th").each(function (i) {
                if ($($(this)).html() == "Status") {
                    categoryIndex = i; return false;
                }
            });
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                var selectedItem = $('#statusFilter').val()
                var category = data[categoryIndex];
                if (selectedItem === "" || category.includes(selectedItem)) {
                    return true;
                }
                    return false;
                }
            );
            $("#statusFilter").change(function (e) {
                table.draw();
            });
                table.draw();
        });
    </script>
<?php
    require_once("../included/footer.php");
?>
