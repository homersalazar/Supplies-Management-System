<?php
require_once("../users/auth.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>

    <link rel="stylesheet" href="../css/style.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    
    <script src="../js/live_time.js"></script>
    <script src="../js/export_to_excel.js"></script>
    <script src="../js/print.js"></script>


</head>
    <body>
    <div class="sticky-top">
      <div class="row sticky_top">
        <div class="col-8">
          <h5 class="p-2 title">Supplies Management System <span id="badges" class="badge badge-success ml-0">v1</span></h5>

        </div>
        <div class="col-4  text-right">
          <span class="nms"><?php echo $_SESSION['UserLogin']; ?></span><span  class="dropdown">
              <button id="btn1" class="btn fa fa-user-circle fa-2x text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"></button>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item fa fa-user" href="../users/profile.php?id=<?php echo $_SESSION['ID'];  ?>"> Profile</a>
                <a class="dropdown-item fa fa-cog" href="#"> Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item fa fa-sign-out" href="../users/logout.php"> Logout</a>
                
              </div>
          </span>
        </div>
      </div>
    </div>


