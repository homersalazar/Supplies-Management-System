<?php 
// require_once("../included/header.php");
require_once("../included/connection.php");
?>

<div class="sidenav">
  <?php if($_SESSION['Access'] == "admin"){ ?>
    <a
    
     href="../dashboard/index.php"> Home</a>        
  <?php  }else { ?>
    <a href="../dashboard/dashboard.php"> Home</a>
  <?php } ?>
  <hr id="hr">
  <label class="tables">Tables</label>
  <?php if($_SESSION['Access'] == "admin"){ ?>
    <a href="../customer/customer.php">Employee</a>
    <a href="../product/product.php">Product</a>
    <a href="../transaction/transaction.php">Transaction</a>
    <a href="../inventory/inventory.php">Order List</a>
    <a href="../cart/cart.php">Purchase</a>
    <a href="../panel/control_panel.php">Control Panel</a>
    <a href="../employee/employee.php">User</a>
    <a href="../report/option.php">Report</a>
  <?php  }else { ?>
    <a href="../transaction/supplies.php">Office Supplies</a>
    <a href="../inventory/order.php">Order List</a>
    <!-- <a href="../inventory/inventory.php">Inventory</a> -->
  <?php } ?>

  <hr id="hr">
</div>
