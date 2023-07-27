<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    $sql = "SELECT *, m.id as m_id FROM mpr m
    LEFT JOIN product p ON p.id = m.mprId";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn)); 
?>  
    <div id="main">
        <div class="row ml-5 mt-4">
            <div class="col-11">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <span><b>MPR </b></span> 
                                <!-- <span>
                                    <form action="destroy_function.php" method="POST"></form>
                                        <button type="submit" class="btn btn-danger btn-sm fa fa-times"> Delete all</button>
                                    </form>
                                </span> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="mpr_table" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">Item Name</th>
                                    <th width="10%">Quantity</th>
                                    <th width="10%">Unit</th>
                                    <th width="15%">Item Code</th>
                                    <th width="15%">Category</th>
                                    <th width="1%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  while($row = mysqli_fetch_array($result)){  ?>  
                                    <tr>                                    
                                        <td><?= $row['color'] . ' ' . $row['item_name'] . ' ' . $row['size'] ?></td>
                                        <td><?= $row['mprQty'] ?></td>
                                        <td><?= $row['unit'] ?></td>
                                        <td><?= $row['item_code'] ?></td>
                                        <td><?= $row['category'] ?></td>
                                        <td>
                                        <button class="btn btn-success btn-sm pt-2 fa fa-edit" onclick="editMpr('<?php echo $row['m_id']; ?>' , '<?php echo $row['item_name']; ?>', '<?php echo $row['color']; ?>' , '<?php echo $row['size']; ?>' , '<?php echo $row['item_code']; ?>' , '<?php echo $row['mprQty']; ?>' )"> Edit</button>
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

    <!-- edit mpr modal -->
    <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">MPR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="mpr_form">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <input type="text" name="combined" id="combined" class="form-control form-control-sm"  required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <input type="text" name="mprCode" id="mprCode" class="form-control form-control-sm" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <input type="number" name="mprQty" id="mprQty" class="form-control form-control-sm" placeholder="Quantity" required  >
                            
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-start">
                        <input type="hidden" id="mprId" name="mprId">
                        <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                        <button type="button" class="btn btn-danger  fa fa-times" data-dismiss="modal"> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const editMpr = (mprId , mprItemName, mprColor, mprSize, mprCode, mprQty) =>{
            $('#editModal').modal('show');
            $("#mprId").val(mprId);
            var Color = (mprColor != '' ? mprColor + ' ' : '');
            var combinedValues = Color + mprItemName + "  " + mprSize;
            $("#combined").val(combinedValues);
            $("#mprCode").val(mprCode);
            $("#mprQty").val(mprQty);
            $('#editModal').on('shown.bs.modal', function () {
                $('#mprQty').focus();
            })
            $('#mpr_form').on("submit", function(event){ 
                $.ajax({  
                    url:"update_function.php",  
                    method:"POST",  
                    data:$('#mpr_form').serialize(),  
                    success:function(data){  
                        $('#mpr_form')[0].reset();  
                        $('#editModal').modal('hide');  
                        window.location.reload();
                    }  
                });                  
            });  
        }
        
        $(document).ready(function() {
            $('#mpr_table').DataTable();
        });
    </script>
<?php
    require_once("../included/footer.php");
?>