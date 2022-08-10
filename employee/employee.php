<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    
    $sql = "SELECT * FROM users";  
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
                    <span><b>Employee</b></span> 
                    <!-- <span><button type="button" class="btn btn-primary btn-sm fa fa-plus" data-toggle="modal" data-target="#customer"></button></span> -->
                </div>
                <div class="card-body">
                    <table id="customer_table" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                            <!-- <th scope="col">First Name</th>
                            <th scope="col">Last Name</th> -->
                            <th scope="col">Employee Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Department</th>
                            <!-- <th width="12%">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php  while($row = mysqli_fetch_array($result)){
                                $department = $row['dept'];
                            ?>  
                                <tr>
                                <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                                <!-- <td><?php echo $row['lname']; ?></td> -->
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php   
                                    if($department == 0){
                                        echo "Accounting Department";
                                    }elseif($department == 1){
                                        echo "Finance Department";
                                    }elseif($department == 2){
                                        echo "Purchasing Department";
                                    }elseif($department == 3){
                                        echo "HR Department";
                                    }elseif($department == 4){
                                        echo "IT Department";
                                    }elseif($department == 5){
                                        echo "Pinugay Yard";
                                    }elseif($department == 6){
                                        echo "Executive Department";
                                    }elseif($department == 7){
                                        echo "Audit Department";
                                    }            
                               ?></td>
                                    <!-- <td>
                                        <small><div class="btn-group">
                                            <a type="button" class="btn btn-primary btn-sm fa fa-list fa-xs" href="../customer/customer_detail.php?id=<?php echo $row['id']; ?>"> Details</a>
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">   
                                                <span class="sr-only">...</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right   ">
                                                <a class="dropdown-item pt-2" href="../customer/edit_customer.php?id=<?php echo $row['id']; ?>">Edit</a>
                                            </div>
                                        </div></small> 
                                    </td> -->
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
                                <option value="0">Accounting Department</option>
                                <option value="1">Finance Department</option>
                                <option value="2">Purchasing Department</option>
                                <option value="3">HR Department</option>
                                <option value="4">IT Department</option>
                                <option value="6">Executive Department</option>
                                <option value="7">Audit Department</option>
                                <option value="5">Pinugay Yard</option>
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
