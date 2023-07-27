<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    require_once("modal.php");
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
                                <th width="5%">Quantity</th>
                                <th width="15%">Item Code</th>
                                <th width="10%">Size</th>
                                <th width="14%">Category</th>
                                <th width="10%">Status</th>
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
                                    <td><?php echo $row['item_code']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td <?php echo $color; ?>><?php echo $status; ?></td>
                                    <td>
                                        <small><div class="btn-group">
                                            <a type="button" class="btn btn-danger btn-sm fa fa-list fa-xs" href="#" onclick="detail('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>', '<?php echo $row['unit']; ?>', '<?php echo $row['color']; ?>', '<?php echo $row['size']; ?>', '<?php echo $row['category']; ?>', '<?php echo $row['description']; ?>')"> Details</a>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                <span class="sr-only">...</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item pt-2" onclick="mpr_function('<?php echo $row['id']; ?>' , '<?php echo $row['item_name']; ?>' , '<?php echo $row['quantity']; ?>' )">MPR</a>
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


    <script>
        const detail = (d_id, s_name, amount, u_nit, color, size, ctgy, stats, disc) => {
            $('#details').modal('show');
            $("#d_id").val(d_id);
            $("#s_name").val(s_name);
            $("#amount").val(amount);
            $("#u_nit").val(u_nit);
            $("#color").val(color);
            $("#size").val(size);
            $("#ctgy").val(ctgy);
            $("#stats").val(stats);
            $("#disc").val(disc);
        }

        const mpr_function = (mprId, mprItemName, mprStock) =>{
            $('#mprModal').modal('show');
            $("#mprId").val(mprId);
            $("#mprItemName").val(mprItemName);
            $("#mprStock").val(mprStock);
            $('#mprModal').on('shown.bs.modal', function () {
                $('#mprQty').focus();
            })
            $('#mpr_form').on("submit", function(event){ 
                $.ajax({  
                    url:"mpr_function.php",  
                    method:"POST",  
                    data:$('#mpr_form').serialize(),  
                    success:function(data){  
                        $('#mpr_form')[0].reset();  
                        $('#mprModal').modal('hide');  
                        window.location.reload();
                        return false;
                    }  
                });                  
            });  
        }

        const order_function = (t_id , tname , qty ) => {
            $('#order').modal('show');
            $('#order').on('shown.bs.modal', function () {
                $('#customer').focus();
            })
            $("#t_id").val(t_id);
            $("#tname").val(tname);
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

        const return_function = (r_id , rname , quan) => {
            $('#return').modal('show');
            $('#return').on('shown.bs.modal', function () {
                $('#cus').focus();
            })
            $("#r_id").val(r_id);
            $("#rname").val(rname);
            $("#quan").val(quan);
            $('#return_form').on("submit", function(event){ 
                $.ajax({  
                    url:"return_order_function.php",  
                    method:"POST",  
                    data:$('#return_form').serialize(),  
                    success:function(data){  
                        $('#return_form')[0].reset();  
                        $('#return').modal('hide');  
                        $('#transaction_table').html(data);  
                    }  
                });                  
            });
        }

        const request_function = (i_id , sname , qty ) => {
            $('#transaction').modal('show');
            $('#transaction').on('shown.bs.modal', function () {
                $('#customer').focus();
            })
            $("#i_id").val(i_id);
            $("#sname").val(sname);
            $("#qty").val(qty);
            $('#transaction_form').on("submit", function(event){ 
                var stock = document.getElementById('qty').value;
                var num = document.getElementById('quantities').value;
                stock  = parseInt(stock);
                num =  parseInt(num);

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

        const add_item = (items_id, quantitys) => {
            $("#items_id").val(items_id);
            $("#quantitys").val(quantitys);
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