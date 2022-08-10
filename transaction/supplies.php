<?php 
    session_start();
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    $sql = "SELECT * FROM product";  
    $result = mysqli_query($conn, $sql);  
?>  
<div id="main">
<div class="row ml-5 mt-4">
        <div class="col-11">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-2">
                            <span><b>Office Supplies</b></span> 
                        </div>
                        <div class="col-2">
                            <select id="statusFilter" class="form-control form-control-sm">
                                <option value="">Show All</option>
                                <option value="Available">Available</option>
                                <option value="Low Stock">Low Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="transaction_table" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                            <th width="20%">Item Name</th>
                            <th width="11%">Quantity</th>
                            <th width="11%">Size</th>
                            <th width="18%">Category</th>
                            <th width="11%">Status</th>
                            <th width="15%">Description</th>
                            <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){ 
                                $status = "";
                                $qty = $row["quantity"];
                            if($qty <= 5){
                                $status = "Low Stock";
                                $color = 'class="text-warning"';
                            }   
                            if($qty == 0){
                                $status = "Out of Stock"; 
                                $color = 'class="text-danger"';
                            }
                            if($qty > 5){
                                $color = 'class="text-success"';
                                $status = "Available";
                            }
                            $qty = $row['quantity'];
                            $request = $preorder =  "";
                            if($qty == "0"){
                                $request = "disabled";
                            }
                            if($qty > "0"){
                                $preorder = "disabled";
                            }
                            ?>  
                                <tr>
                                    <td><?php echo $row['color']; ?> <?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['quantity']; ?> <?php echo $row['unit']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td <?php echo $color; ?>><?php echo $status; ?></td>
                                    <td></td>
                                    <td>
                                        <small><div class="btn-group">
                                            <a type="button" class="btn btn-danger btn-sm fa fa-list fa-xs" href="#" > Details</a>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                <span class="sr-only">...</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item pt-2 <?php echo $preorder ?>" onclick="order_function('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>' )">Pre Order</a>
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
        </div>
    </div>   
<!-- add transaction modal -->
<div class="modal fade" id="transaction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Request Supply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="myFunction()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="transaction_form">
                    <div class="row">
                        <div class="col-12">
                            <!-- <div id="demo" style="display: none" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Insufficient Stock!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> -->
                            <div class="alert  alert-danger" style="display: none" id="success-alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Insufficient Stock!</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="text" name="tname" id="tname" class="form-control form-control-sm" placeholder="Item Name" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="number" name="quantities" id="quantities" class="form-control form-control-sm" placeholder="Quantity" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                           
                        </div>
                    </div>
                    <div class="row mt-2">
                            <span class="text-secondary ml-4"><small>Remaining stock:</small></span> <span><input type="text" id="qty" name="qty" class="form-control form-control-sm ml-2" readonly></span>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <input type="hidden" id="t_id" name="t_id">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                    <button type="button" class="btn btn-danger  fa fa-times" data-dismiss="modal" onclick="myFunction()"> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add order modal -->
<div class="modal fade" id="order" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pre Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="myFunction()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="order_form">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert  alert-danger" style="display: none" id="success-alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Insufficient Stock!</strong>
                            </div>
                            <select name="customer" id="customer" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Select Customer</option>
                                <?php $sql1 ="SELECT * FROM customer ORDER BY fname ASC";
                                    $result1 = mysqli_query($conn, $sql1);  
                                    while($row1 = mysqli_fetch_array($result1)){ ?>
                                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['fname']; ?> <?php echo $row1['lname']; ?></option>
                                <?php } ?>
                            </select>                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="text" name="tname" id="tname" class="form-control form-control-sm" placeholder="Item Name" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="number" name="quantities" id="quantities" class="form-control form-control-sm" placeholder="Quantity" required  >
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="date" name="record_date" id="record_date" class="form-control form-control-sm" placeholder="Date" required  >
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <input type="hidden" id="t_id" name="t_id">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                    <button type="button" class="btn btn-danger  fa fa-times" data-dismiss="modal" onclick="myFunction()"> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function order_function(t_id , tname , qty ) {
        $('#order').modal('show');
        $('#order').on('shown.bs.modal', function () {
            $('#customer').focus();
        })
        document.getElementById("t_id").value = t_id;
        document.getElementById("tname").value = tname;
        $('#order_form').on("submit", function(event){ 
            $.ajax({  
                url:"pre_order_function.php",  
                method:"POST",  
                data:$('#order_form').serialize(),  
                success:function(data){  
                    $('#order_form')[0].reset();  
                    $('#order').modal('hide');  
                    $('#transaction_table').html(data);  
                    window.location.reload();
                    // location.reload();
                    return false;
                }  
            });                  
        });  
    }
    function request_function(t_id , tname , qty ) {
        $('#transaction').modal('show');
        $('#transaction').on('shown.bs.modal', function () {
            $('#customer').focus();
        })
        document.getElementById("t_id").value = t_id;
        document.getElementById("tname").value = tname;
        document.getElementById("qty").value = qty;
        $('#transaction_form').on("submit", function(event){  
            var stock= document.getElementById('qty').value;
            var num = document.getElementById('quantities').value;
            if(num > stock ){
                document.getElementById("success-alert").style.display = 'block';  
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                    });
                return false;
            }else{
                $.ajax({  
                    url:"supplies_function.php",  
                    method:"POST",  
                    data:$('#transaction_form').serialize(),  
                    success:function(data){  
                        $('#transaction_form')[0].reset();  
                        $('#transaction').modal('hide');  
                        $('#transaction_table').html(data);  
                        window.location.reload();
                        // location.reload();
                        return false;
                    }  
                });                  
            }
        });  
    }
    function myFunction() {
        document.getElementById("transaction_form").reset();
        document.getElementById("demo").reset();
    }
    $(document).ready(function() {
        var table = $('#transaction_table').DataTable();
        var categoryIndex = 0;
        $("#transaction_table th").each(function (i) {
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