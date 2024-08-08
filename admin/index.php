<?php
require "conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href = "css/admin1.css" rel ="stylesheet" >
</head>

<body>

    <div class="sidenav">
        <div class="login-main-text">
            <h2>Admin<br> Login Page</h2>
            
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="post" >
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control usrnm" name="usrnm" id="usrnm" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control pswd" name="pswd" id = "pswd" placeholder="Password">
                    </div>
                    <button type="submit" name="Login" class="btn btn-black">Login</button>
                    <!--<button type="submit" name="Register" class="btn btn-secondary">Register</button>-->
                </form>
            </div>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <?php
        if(isset($_POST['Login']))
        {
            $query = "SELECT * FROM `admin_users` WHERE `usrnm`='$_POST[usrnm]' AND `pswd`='$_POST[pswd]'";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) == 1)
            {
                session_start();
                $_SESSION['id'] = $_POST['usrnm'];
                header("Location: admin.php");
                
            }
            else
            {
                echo "<script>alert('Incorrect Password');</script>";
            }
        }
    ?>
</body>

</html>