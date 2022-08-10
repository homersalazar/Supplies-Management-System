<?php

require_once("../included/connection.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

  <div class="container">   
        <div class="row">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Department</th>
                        <th>Item</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        $sql = mysqli_query($conn, " SELECT item_id, item_name, product.unit AS p_unit, request_date,
                        GROUP_CONCAT(CONCAT_WS(' ', item_name, product.size) SEPARATOR '<br>') AS items

                        FROM transaction
                        
                            LEFT JOIN product ON (product.id=transaction.item_id)
                            LEFT JOIN customer ON (customer.id=transaction.c_id)
                        
                        
                        GROUP BY customer.depart 
                        
                        
                        ");

                        while($row = mysqli_fetch_array($sql)){
                            $department = $row['depart'];
                            $dis_result = "";

                            if($department == 0){
                                $dis_result = "Accounting Department";
                            }elseif($department == 1){
                                $dis_result = "Finance Department";
                            }elseif($department == 2){
                                $dis_result = "Purchasing Department";
                            }elseif($department == 3){
                                $dis_result = "Hr Department";
                            }elseif($department == 4){
                                $dis_result = "IT Department";
                            }elseif($department == 5){
                                $dis_result = "Pinugay Yard";
                            }elseif($department == 6){
                                $dis_result = "Executive Department";
                            } elseif($department == 7){
                                $dis_result = "Audit Department";
                            }         

                            echo '<tr>';
                            echo '<td>'.$dis_result.'</td>';
                            echo '<td>'.date('d-M-y', strtotime($row['request_date'])).'</td>';
                            echo '<td>'.$row['items'].'</td>';
                            // echo '<td>'.$row['totals'].'</td>';
                            echo '</tr>';
                        }

                    ?>
                        
                </tbody>

            </table>
        </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>