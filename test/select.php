
<?php
require_once("../included/connection.php");
if(ISSET($_POST['filter'])){
        $category=$_POST['category'];
 
        $query=mysqli_query($conn, "SELECT * FROM `motors` WHERE `category`='$category'") or die(mysqli_error($conn));
        while($fetch=mysqli_fetch_array($query)){
            echo"<tr><td>".$fetch['name']."</td><td>".$fetch['category']."</td></tr>";
        }
    }else if(ISSET($_POST['reset'])){
        $query=mysqli_query($conn, "SELECT * FROM `motors`") or die(mysqli_error());
        while($fetch=mysqli_fetch_array($query)){
            echo"<tr><td>".$fetch['name']."</td><td>".$fetch['category']."</td></tr>";
        }
    }else{
        $query=mysqli_query($conn, "SELECT * FROM `motors`") or die(mysqli_error());
        while($fetch=mysqli_fetch_array($query)){
            echo"<tr><td>".$fetch['name']."</td><td>".$fetch['category']."</td></tr>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    </head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://sourcecodester.com">Sourcecodester</a>
        </div>
    </nav>
    <div class="col-md-3"></div>
    <div class="col-md-6 well">
        <h3 class="text-primary">PHP - Drop Down Filter Selection</h3>
        <hr style="border-top:1px dotted #ccc;"/>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" action="">
                <div class="form-inline">
                    <label>Category:</label>
                    <select class="form-control" name="category">
                        <option value="bond paper">Suzuki</option>
                        <option value="Honda">Honda</option>
                        <option value="Kawasaki">Kawasaki</option>
                    </select>
                    <button class="btn btn-primary" name="filter">Filter</button>
                    <button class="btn btn-success" name="reset">Reset</button>
                </div>
            </form>
            <br /><br />
            <table class="table table-bordered">
                <thead class="alert-info">
                    <th>Name</th>
                    <th>Brand</th>
                </thead>
                <thead>

                </thead>
            </table>
        </div>
    </div>
</body>	
</html>

