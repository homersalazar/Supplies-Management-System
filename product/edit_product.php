<?php 
    require_once("../included/connection.php");
    require_once("../included/header.php");
    require_once("../included/navigation.php");
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id ='$id'";  
    $result = mysqli_query($conn, $sql);  
    $row = $result->fetch_assoc();

?>
<div id="detail">
    <div class="container bg-white">
        <div class="row ">
            <div class="col-12 text-primary text-center mt-4">
                <h6>Edit Product</h6>
            </div>
        </div>
        <div class="row">
            <a type="button" class="btn btn-primary btn-block fa fa-reply mt-2 mr-3 ml-3" href="../product/product.php"> Back</a>
        </div>
        <form method="POST" action="update_product_function.php?id=<?php echo $row['id']; ?>">
            <div class="row mt-3 border border-primary border-top-0 border-right-0 border-left-0 pb-4">
                <div class="col-3 text-right text-info mt-3">
                    <label>Item Name:</label>
                </div>
                <div class="col-9 mt-3">
                    <input type="text" name="item_name" id="item_name" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['item_name']; ?>">
                </div>
                <div class="col-3 text-right text-info mt-3">
                    <label>ALU:</label>
                </div>
                <div class="col-9 mt-3">
                    <input type="text" name="item_code" id="item_code" class="form-control form-control-sm" autocomplete="off"  value="<?php echo $row['item_code']; ?>">
                </div>
                <div class="col-3 text-right text-info mt-3">
                    <label>Size:</label>
                </div>
                <div class="col-9 mt-3">
                    <input type="text" name="size" id="size" class="form-control form-control-sm" autocomplete="off"  value="<?php echo $row['size']; ?>">
                </div>
                <div class="col-3 text-right text-info mt-3">
                    <label>Unit:</label>
                </div>
                <div class="col-9 mt-3">
                    <select name="unit" id="unit" class="form-control form-control-sm" >
                        <option value="" disabled selected>Select Unit</option>
                        <option value="Pieces" <?php if ($row['unit'] == "Pieces"): ?> selected="selected"<?php endif; ?>> Pieces</option>
                        <option value="Inches" <?php if ($row['unit'] == "Inches"): ?> selected="selected"<?php endif; ?>> Inches</option>
                        <option value="Boxes" <?php if ($row['unit'] == "Boxes"): ?> selected="selected"<?php endif; ?>> Boxes</option>
                        <option value="Liters" <?php if ($row['unit'] == "Liters"): ?> selected="selected"<?php endif; ?>> Liters</option>
                        <option value="Rim" <?php if ($row['unit'] == "Rim"): ?> selected="selected"<?php endif; ?>> Rim</option>
                        <option value="mL" <?php if ($row['unit'] == "mL"): ?> selected="selected"<?php endif; ?>> mL</option>
                        <option value="Gallon" <?php if ($row['unit'] == "Gallon"): ?> selected="selected"<?php endif; ?>> Gallon</option>
                    </select>
                </div>
                <div class="col-3 text-right text-info mt-3">
                    <label>Color:</label>
                </div>
                <div class="col-9 mt-3">
                    <input type="text" name="color" id="color" class="form-control form-control-sm" autocomplete="off" value="<?php echo $row['color']; ?>" >
                </div>
                <div class="col-3 text-right text-info mt-3">
                    <label>Category:</label>
                </div>
                <div class="col-9 mt-3">
                    <select name="category" id="category" class="form-control form-control-sm">
                        <option value="cate" disabled selected>Select Category</option>
                        <option value="Cleaning Supplies" <?php if ($row['category'] == "Cleaning Supplies"): ?> selected="selected"<?php endif; ?>> Cleaning Supplies</option>
                        <option value="Writing Utensils" <?php if ($row['category'] == "Writing Utensils"): ?> selected="selected"<?php endif; ?>> Writing Utensils</option>
                        <option value="Paper Supplies" <?php if ($row['category'] == "Paper Supplies"): ?> selected="selected"<?php endif; ?>> Paper Supplies</option>
                        <option value="Office Supplies" <?php if ($row['category'] == "Office Supplies"): ?> selected="selected"<?php endif; ?>> Office Supplies</option>
                        <option value="Filing Supplies" <?php if ($row['category'] == "Filing Supplies"): ?> selected="selected"<?php endif; ?>> Filing Supplies</option>
                        <option value="Equipment" <?php if ($row['category'] == "Equipment"): ?> selected="selected"<?php endif; ?>> Equipment</option>
                    </select>  
                </div>
                <div class="col-3 text-right text-info mt-3">
                    <label>Remarks:</label>
                </div>
                <div class="col-9 mt-3">
                    <textarea class="form-control" id="disc" name="disc" rows="4" cols="80"><?php echo $row['description']; ?></textarea>
                </div>
                <div class="col-11 mt-2">
                    <Button type="submit" name="submit" id="submit" class="btn btn-info btn-block fa fa-edit mr-2 mt-4 ml-4"> Update</Button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    require_once("../included/footer.php");
?>