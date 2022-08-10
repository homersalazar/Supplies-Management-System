<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    
    
    $sql = "SELECT department.depart AS dept,
    customer.lname,
    customer.fname,
    customer.id AS ids
    FROM `customer`
    LEFT JOIN department ON (customer.depart = department.depart_num)";    
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
                    <span><b>Employee</b></span> <span><button type="button" class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#customer"></button></span>
                </div>
                <div class="card-body">
                    <table id="customer_table" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){
                            ?>  
                                <tr>
                                    <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['dept']; ?></td>
                                    <td>
                                        <small><div class="btn-group">
                                            <a type="button" class="btn btn-primary btn-sm fa fa-list fa-xs" href="../customer/customer_detail.php?id=<?php echo $row['ids']; ?>"> Details</a>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                <span class="sr-only">...</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right   ">
                                                <a class="dropdown-item pt-2" href="../customer/edit_customer.php?id=<?php echo $row['ids']; ?>">Edit</a>
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
    <!-- add customer modal -->
<div class="modal fade" id="customer" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="insert_form">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="fname" id="fname" class="form-control form-control-sm" placeholder="First Name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <input type="text" name="lname" id="lname" class="form-control form-control-sm" placeholder="Last Name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <select name="depart" id="depart" class="form-control form-control-sm" required>
                                <option selected="true" disabled="disabled">Select Department</option>
                                <?php $sql1 ="SELECT * FROM department";
                                    $result1 = mysqli_query($conn, $sql1);  
                                    while($row1 = mysqli_fetch_array($result1)){ ?>
                                <option value="<?php echo $row1['depart_num']; ?>"><?php echo $row1['depart']; ?></option>
                                <?php } ?>
                            </select>                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                    <button type="reset" class="btn btn-danger fa fa-times"> Reset</button>
                    <button type="button" class="btn btn-secondary btn-sm fa fa-times" data-dismiss="modal"> Close</button>
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
        $('#customer').on('shown.bs.modal', function () {
            $('#fname').focus();
        })  
        $('#insert_form').on("submit", function(event){  
            $.ajax({  
                url:"../customer/customer_function.php",  
                method:"POST",  
                data:$('#insert_form').serialize(),  
                success:function(data){  
                    $('#insert_form')[0].reset();  
                    $('#customer').modal('hide');  
                    $('#customer_table').html(data); 
                    window.location.reload();
                }  
            });  
        }); 

        $('#customer_table').DataTable();
    });
</script>
<?php
    require_once("../included/footer.php");
?>
