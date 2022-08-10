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
                <h6>Product's Detail</h6>
            </div>
        </div>
        <div class="row">
            <a type="button" class="btn btn-primary btn-block fa fa-reply mt-2 mr-3 ml-3" href="../product/product.php"> Back</a>
        </div>
        <div class="row mt-3 border border-info border-top-0 border-right-0 border-left-0 pb-4">
            <div class="col-3 text-right text-info mt-2">
                <label>Item Name:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["item_name"]; ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Quantity:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["quantity"]; ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Size:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["size"]; ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Unit:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["unit"]; ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Color:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["color"]; ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Category:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["category"]; ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Status:</label>
            </div>
            <div class="col-9 mt-2">
                <span><?php 
                    if($row['quantity'] == 0){
                        echo "Out of Stock";
                    }elseif($row['quantity'] < 5 ){
                        echo "Low Stock";
                    }elseif($row['quantity'] >= 5 ){
                        echo "Available";
                    }
                ?></span>
            </div>
            <div class="col-3 text-right text-info mt-2">
                <label>Remarks:</label>
            </div>
            <div class="col-9 mt-2">
                <?php echo $row["description"]; ?></span>
            </div>
        </div>  
    </div>
</div>
<?php
    require_once("../included/footer.php");
?>