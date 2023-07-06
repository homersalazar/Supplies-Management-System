<?php 
require_once("../included/connection.php");
     if(isset($_POST["query"])){  
          $output = '';  
          $sql = "SELECT * FROM product WHERE item_name LIKE '%".$_POST["query"]."%' or color LIKE '%".$_POST["query"]."%' LIMIT 10";  
          $result = mysqli_query($conn, $sql);  
          $output = '<ul class="list-unstyled">';  
     if(mysqli_num_rows($result) > 0){  
               while($row = mysqli_fetch_array($result))  {

               $size = !empty($row["size"])  ? "- ".$row["size"] : "" ;
               $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;

               $id = $row["id"];
               $item_name = $row["item_name"];

               $quantities = $row["quantity"];
               $sizes = $row["size"];
               $units = $row["unit"];
               $colors = $row["color"];
               $categories = $row["category"];
                    $output .= '<li class="pl-2" onclick="add_item('.$id.' , '.$quantities.')"> '.$colors.' '.$item_name.'  '.$size.'</li>';  
               }  
          }else{  
               $output .= '<li>Item Not Found</li>';  
          }  
          $output .= '</ul>';  
          echo $output;  
     }  
?>
