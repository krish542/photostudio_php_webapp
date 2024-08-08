<?php 
require "conn.php";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user = $pass = "";
    if(isset($_POST['login']))
    {
        $usrnm = $_POST['username'];
        $pass = $_POST['pass'];
        $query1 = "SELECT * FROM `tbl_users` WHERE `mail` = '".$usrnm."'";
        $result = mysqli_query($con, $query1);
        $count = 0;
        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            while($row = mysqli_fetch_array($result))
            {
                if(password_verify($pass, $row['pass']))
                {
                    session_start();
                    $_SESSION['user_mail'] = $_POST['username'];
                    header("Location: index.php");
                }
                else
                {
                    echo "Invalid credentials";
                }
            }
        }
        else{
            $err1 = "No such email address found in our database\nSign Up instead";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/css/login.css">
    <style>

    </style>
    <title>Document</title>
</head>

<body>
    <!--<section class="ftco-section">-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap py-5">
                        <h3 class="text-center mb-0">Welcome</h3>
                        <form action="" class="login-form" method="POST">
                            <div class="form-group">
                            <label>E-mail: </label>
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
                                <input type="text" class="form-control" placeholder="Username" required name="username" <?php if(isset($usrnm)) echo "value=".$usrnm; ?>>
                                <span><?php if (isset($err1)) {
                                                echo $err1;
                                            }
                                            ?></span>
                            </div>
                            <div class="form-group">
                            <label>Password: </label>
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                                <input type="password" class="form-control" placeholder="Password" required name="pass">
                            </div>
                            
                            <div class="form-group d-md-flex">
                                <div class="w-100 text-md-right">
                                    <a href="#">Forgot Password</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn form-control btn-primary rounded submit px-3" name="login">Log In</button>
                            </div>
                        </form>
                        <div class="w-100 text-center mt-4 text">
                            <p class="mb-0">Don't have an account?</p>
                            <a href="signin.php">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</section>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>