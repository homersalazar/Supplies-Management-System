<?php 
require_once("../included/connection.php");
    session_start();
if (isset($_POST['submit'])) {
    $username    = mysqli_real_escape_string($conn, $_POST["username"]);
    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
    $access = "user";

  
    $sql = "SELECT * FROM users WHERE username = '$username'  LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) { // if user exists
        if ($row['username'] === $username) {
            echo '<script> alert("Username already exists")</script>';
        }
    }else if($_POST["password"] != $_POST["confirm_password"]){
        echo '<script> alert("Password not match!")</script>';
    }else{
        // $emp_id =  $_SESSION['ID'] + 1;
        $sql1    = "INSERT INTO users (username, email, password, access ) VALUES ('$username' , '$email' , '" . md5($password) . "' , '$access')";
        $result1   = mysqli_query($conn, $sql1);
        if($result1) {
        echo '<script> alert("You are registered successfully")</script>';
        }else {
            echo '<script> alert("Registration failed")</script>';
        }
    }
    mysqli_close($conn);

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
        *:focus {
            outline: none;
        }

        body {
            margin: 0;
            padding: 0;
            background: #DDD;
            font-size: 16px;
            color: #222;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
        }         

        #login-box {
            position: relative;
            margin: 5% auto;
            width: 600px;
            height: 400px;
            background: #FFF;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .left {
            position: absolute;
            top: 0;
            left: 0;
            box-sizing: border-box;
            padding: 40px;
            width: 300px;
            height: 400px;
        }

        h1 {
            margin: 0 0 20px 0;
            font-weight: 300;
            font-size: 28px;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            box-sizing: border-box;
            margin-bottom: 20px;
            padding: 4px;
            width: 220px;
            height: 32px;
            border: none;
            border-bottom: 1px solid #AAA;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 15px;
            transition: 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-bottom: 2px solid #16a085;
            color: #16a085;
            transition: 0.2s ease;
        }

        input[type="submit"] {
            margin-top: 28px;
            width: 120px;
            height: 32px;
            background: #16a085;
            border: none;
            border-radius: 2px;
            color: #FFF;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            text-transform: uppercase;
            transition: 0.1s ease;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="submit"]:focus {
            opacity: 0.8;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            transition: 0.1s ease;
        }

        input[type="submit"]:active {
            opacity: 1;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
            transition: 0.1s ease;
        }

        .right {
            position: absolute;
            top: 0;
            right: 0; 
            box-sizing: border-box;
            padding: 40px;
            width: 350px;
            height: 400px;
            background: url('https://goo.gl/YbktSj');
            background-size: cover;
            background-position: center;
            border-radius: 0 2px 2px 0;
        }

        .right .loginwith {
            display: block;
            margin-bottom: 40px;
            font-size: 28px;
            color: #FFF;
            text-align: center;
        }
        .caa{
            font-size: 13px;
            color: blue;
            margin-left: 2px;
        }
        .ps{
            font-size: 13px;
            margin-left: 20px;
        }
    </style>
    <body>
        <div id="login-box">    
            <form action="" method="POST">
                <div class="left">
                    <h1><b>Sign up</b></h1>
                    <input type="text" name="username" placeholder="Username" autocomplete="off" required/>
                    <input type="text" name="email" placeholder="E-mail" autocomplete="off" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                    <input type="password" name="confirm_password" placeholder="Retype password" required/>
                    <input type="submit" name="submit" value="Register" />
                </div>
            </form>
            <div class="right">
            <!-- <span class="loginwith">Sign in with<br />social network</span> -->
                <img src="../img/images.jpg" width="250" height="280">
                <p class="ps">Already have an account? <a class="caa" href="login.php">Login here</a>.</p>
            </div>
        </div>
    </body>
</html>
