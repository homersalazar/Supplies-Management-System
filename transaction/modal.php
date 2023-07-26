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
                                <!-- <input type="text" name="add_date" id="add_date" class="form-control form-control-sm" value="2023-1-10" readonly> -->
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

<!-- mpr transaction -->
<div class="modal fade" id="mprModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">MPR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="myFunction()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="mpr_form">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <input type="text" name="mprItemName" id="mprItemName" class="form-control form-control-sm" placeholder="Item Name" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <input type="number" name="mprQty" id="mprQty" class="form-control form-control-sm" placeholder="Quantity" required  >
                            
                            </div>
                        </div>
                        <div class="row mt-2">
                                <span class="text-secondary ml-4">
                                    <small>
                                        Remaining stock:
                                    </small>
                                </span> 
                                <span>
                                    <input type="text" id="mprStock" name="mprStock" class="form-control form-control-sm ml-2" readonly>
                                </span>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-start">
                        <input type="hidden" id="mprId" name="mprId">
                        <button type="submit" name="submit" id="submit" class="btn btn-success fa fa-check"> Save</button>
                        <button type="button" class="btn btn-danger  fa fa-times" data-dismiss="modal" onclick="myFunction()"> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>