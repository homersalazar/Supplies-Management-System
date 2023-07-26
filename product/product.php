<?php 
    require_once("../users/auth.php");
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    $sql = "SELECT * FROM product";  
    $result = mysqli_query($conn, $sql);  
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
                    <span><b>Product</b></span> <span><button type="button" class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#product"></button></span>
                </div>
                <div class="card-body">
                    <table id="product_table" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                            <th width="15%">Item Name</th>
                            <th width="12%">Item Code</th>
                            <th width="12%">Color</th>
                            <th width="12%">Size</th>
                            <th width="12%">Unit</th>
                            <th width="12%">Category</th>
                            <th width="7%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){ ?>  
                                <tr>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['item_code']; ?></td>
                                    <td><?php echo $row['color']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['unit']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td>
                                        <small><div class="btn-group">
                                            <a type="button" class="btn btn-info btn-sm fa fa-list fa-xs" href="../product/product_detail.php?id=<?php echo $row['id']; ?>"> Details</a>
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                <span class="sr-only">...</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right   ">
                                                <a class="dropdown-item pt-2" href="../product/edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
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
<!-- add product modal -->
<div class="modal fade" id="product" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="product_form">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="item_name" id="item_name" class="form-control form-control-sm" placeholder="Item Name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <select name="unit" id="unit" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Select Unit</option>
                                <option value="Pieces">Pieces</option>
                                <option value="Inches">Inches</option>
                                <option value="Boxes">Boxes</option>
                                <option value="Liters">Liters</option>
                                <option value="Gallon">Gallon</option>
                                <option value="Ml">Ml</option>
                                <option value="Rim">Rim</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="text" name="size" id="size" class="form-control form-control-sm" placeholder="Size" autocomplete="off">                  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <select name="category" id="category" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="Cleaning Supplies">Cleaning Supplies</option>
                                <option value="Writing Utensils">Writing Utensils</option>
                                <option value="Paper Supplies">Paper Supplies</option>
                                <option value="Office Supplies">Office Supplies</option>
                                <option value="Filing Supplies">Filing Supplies</option>
                                <option value="Equipment">Equipment</option> 
                            </select>                      
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="text" name="color" id="color" class="form-control form-control-sm" placeholder="Color">
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                    <button type="reset" class="btn btn-danger fa fa-times"> Reset</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".middle").fadeTo(2000, 500).slideUp(500, function() {
            $(".middle").slideUp(500);
        });
        $('#product').on('shown.bs.modal', function () {
            $('#item_name').focus();
        })  
        $('#product_form').on("submit", function(event){  
            event.preventDefault();  
            $.ajax({  
                url:"../product/product_function.php",  
                method:"POST",  
                data:$('#product_form').serialize(),  
                // beforeSend:function(){  
                // $('#insert').val("Inserting");  
                // },  
                success:function(data){  
                    $('#product_form')[0].reset();  
                    $('#product').modal('hide');  
                    $('#product_table').html(data); 
                    window.location.reload();

                }  
            });  
        });  
        $('#product_table').DataTable();

    });
</script>
<?php
require_once("../included/footer.php");
?>