<?php 
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
                            <span><b>Transaction</b></span> 
                            <span><button type="button" class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#add_transaction"></button></span>
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
                            <th width="18%">Item Name</th>
                            <th width="15%">Quantity</th>
                            <!-- <th width="11%">Unit</th> -->
                            <th width="11%">Size</th>
                            <th width="14%">Category</th>
                            <th width="11%">Status</th>
                            <th width="14%">Description</th>
                            <th width="12%">Action</th>
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
                                    <td> <?php echo $row['color']; ?> <?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['quantity']; ?> <?php echo $row['unit']; ?></td>
                                    <!-- <td><?php echo $row['unit']; ?></td> -->
                                    <!-- <td><?php echo $row['color']; ?></td> -->
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td <?php echo $color; ?>><?php echo $status; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td>
                                        <small><div class="btn-group">
                                            <a type="button" class="btn btn-danger btn-sm fa fa-list fa-xs" href="#" onclick="detail('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>', '<?php echo $row['unit']; ?>', '<?php echo $row['color']; ?>', '<?php echo $row['size']; ?>', '<?php echo $row['category']; ?>', '<?php echo $row['description']; ?>')"> Details</a>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                <span class="sr-only">...</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item pt-2 <?php echo $preorder ?>" onclick="order_function('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>' )">Pre Order</a>
                                                <a class="dropdown-item pt-2 <?php echo $request ?>" onclick="request_function('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>' )">Request</a>
                                                <a class="dropdown-item pt-2" onclick="return_function('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>' )">Return</a>
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
                            <input type="text" name="sname" id="sname" class="form-control form-control-sm" placeholder="Item Name" required readonly>
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
                    <div class="row mt-2">
                            <span class="text-secondary ml-4"><small>Remaining stock:</small></span> <span><input type="text" id="qty" name="qty" class="form-control form-control-sm ml-2" readonly></span>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <input type="hidden" id="i_id" name="i_id">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                    <button type="button" class="btn btn-danger  fa fa-times" data-dismiss="modal" onclick="myFunction()"> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add transaction modal -->
<div class="modal fade" id="add_transaction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="add_item">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="item_name" id="item_name" class="form-control form-control-sm" placeholder="Search Item Name" required autocomplete="off" required>
                        <small><div id="itemList" class="border border-top-0"></div> </small>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" placeholder="Quantity" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <!-- <input type="text" name="add_date" id="add_date" class="form-control form-control-sm" value="2022-8-1" readonly> -->
                            <input type="date" name="add_date" id="add_date" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <input type="hidden" id="items_id" name="items_id" class="form-control">
                    <input type="hidden" id="quantitys" name="quantitys" class="form-control">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-plus"> Add</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Details Modal -->
<div class="modal fade" id="details" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Times New Roman', Times, serif;" id="staticBackdropLabel">Items Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-3 text-right">
                        <label for="">Item Name:</label>
                        </div>
                        <div class="col-9">
                        <input type="text" name="s_name" id="s_name" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 text-right">
                            <label for="">Quantity:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="amount" id="amount" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 text-right">
                            <label for="">Unit:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="u_nit" id="u_nit" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 text-right">
                            <label for="">Color:</label>
                        </div>                
                        <div class="col-9">
                            <input type="text" name="color" id="color" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 text-right">
                            <label for="">Size:</label>
                        </div>                
                        <div class="col-9">
                            <input type="text" name="size" id="size" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 text-right">
                            <label for="">Category:</label>
                        </div>                
                        <div class="col-9">
                            <input type="text" name="ctgy" id="ctgy" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 text-right">
                            <label for="">Remarks:</label>
                        </div>                
                        <div class="col-9">
                            <input type="text" name="disc" id="disc" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger fa fa-times" data-dismiss="modal"> Close</button>
                <input type="hidden" name="d_id" id="d_id" class="form-control form-control-sm" readonly>
            </div>
        </div>
    </div>
</div>
<!-- return modal -->
<div class="modal fade" id="return" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Return Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="myFunction()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="return_form">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert  alert-danger" style="display: none" id="success-alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Insufficient Stock!</strong>
                            </div>
                            <select name="cus" id="cus" class="form-control form-control-sm" required>
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
                            <input type="text" name="rname" id="rname" class="form-control form-control-sm" placeholder="Item Name" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="number" name="qty" id="qty" class="form-control form-control-sm" placeholder="Quantity" required  >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="date" name="r_date" id="r_date" class="form-control form-control-sm" placeholder="Date" required  >
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <input type="hidden" id="r_id" name="r_id">
                    <input type="hidden" id="quan" name="quan">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                    <button type="button" class="btn btn-danger  fa fa-times" data-dismiss="modal" onclick="myFunction()"> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function detail(d_id, s_name, amount, u_nit, color, size, ctgy, stats, disc){
        $('#details').modal('show');
        document.getElementById("d_id").value = d_id;
        document.getElementById("s_name").value = s_name;
        document.getElementById("amount").value = amount;
        document.getElementById("u_nit").value = u_nit;
        document.getElementById("color").value = color;
        document.getElementById("size").value = size;
        document.getElementById("ctgy").value = ctgy;
        document.getElementById("stats").value = stats;
        document.getElementById("disc").value = disc;
    }
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
    function return_function(r_id , rname , quan) {
        $('#return').modal('show');
        $('#return').on('shown.bs.modal', function () {
            $('#cus').focus();
        })
        document.getElementById("r_id").value = r_id;
        document.getElementById("rname").value = rname;
        document.getElementById("quan").value = quan;
        $('#return_form').on("submit", function(event){ 
            $.ajax({  
                url:"return_order_function.php",  
                method:"POST",  
                data:$('#return_form').serialize(),  
                success:function(data){  
                    $('#return_form')[0].reset();  
                    $('#return').modal('hide');  
                    $('#transaction_table').html(data);  
                    // window.location.reload();
                    // return false;
                }  
            });                  
        });
    }
    function request_function(i_id , sname , qty ) {
        $('#transaction').modal('show');
        $('#transaction').on('shown.bs.modal', function () {
            $('#customer').focus();
        })
        document.getElementById("i_id").value = i_id;
        document.getElementById("sname").value = sname;
        document.getElementById("qty").value = qty;
        $('#transaction_form').on("submit", function(event){ 
            var stock = document.getElementById('qty').value;
            var num = document.getElementById('quantities').value;
            stock  = parseInt(stock);
            num =  parseInt(num);
            // return false;

            if(num > stock ){
                document.getElementById("success-alert").style.display = 'block';  
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                    });
                // return false;
            }else{
                $.ajax({  
                    url:"request_transaction_function.php",  
                    method:"POST",  
                    data:$('#transaction_form').serialize(),  
                    success:function(data){  
                        $('#transaction_form')[0].reset();  
                        $('#transaction').modal('hide');  
                        $('#transaction_table').html(data);  
                        // window.location.reload();
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
    function add_item(items_id, quantitys){
        document.getElementById("items_id").value = items_id;
        document.getElementById("quantitys").value = quantitys;

    }
    $(document).ready(function() {
        $('#item_name').keyup(function(){  
            var query = $(this).val();  
            if(query != ''){  
                $.ajax({  
                    url:"../transaction/search.php",  
                    method:"POST",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        $('#itemList').fadeIn();  
                        $('#itemList').html(data);  
                    }  
                });  
            }  
        });  
        $(document).on('click', 'li', function(){  
            $('#item_name').val($(this).text());  
            $('#itemList').fadeOut();  
        });  

        $('#add_item').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"../transaction/add.php",  
                method:"POST",  
                data:$('#add_item').serialize(),  
                success:function(data){  
                    $('#add_item')[0].reset();  
                    $('#add_transaction').modal('hide');  
                    $('#transaction_table').html(data);  
                    window.location.reload();
                }  
            });  
        });
        $('#add_transaction').on('hidden.bs.modal', function(e) {
            $(this).find('#add_item ')[0].reset();
        });
        // $('#transaction_table').DataTable();
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