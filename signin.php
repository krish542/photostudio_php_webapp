<?php
require "conn.php";
$err_name = $err_mail = $err_mail_val = $err_contact = $err_pass = $err_contact_val = "";
$name = $mail = $cont = $pass = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['signup'])) {
        if (empty($_POST['c_name'])) {
            $err_name = "Please enter name!";
        } else {
            $name = $_POST['c_name'];
        }
        if (empty($_POST['mail'])) {
            $err_mail = "Please enter Mail!";
        } else {
            $mail_val = $_POST['mail'];
            if (!filter_var($mail_val, FILTER_VALIDATE_EMAIL)) {
                $err_mail_val = "Please enter valid Mail!";
            } else {
                $mail = $_POST['mail'];
            }
        }
        if (empty($_POST['mob'])) {
            $err_contact = "Please enter mobile number!";
        } else {
            $cont_val = $_POST['mob'];
            if (is_numeric($cont_val) == false) {
                $err_contact_val = "Please enter numeric values only";
            } elseif (strlen($cont_val) < 10) {
                $err_contact_val = "Please enter 10 digits";
            } else {
                $cont = $_POST['mob'];
            }
        }
        if (empty($_POST['pass'])) {
            $err_pass = "Please enter password!";
        } else {
            $pass = $_POST['pass'];
            $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
        }
        if (!empty($name) && !empty($mail) && !empty($cont) && !empty($pass)) {
            echo $name . $mail . $cont . $pass;
            $ins_user = "INSERT INTO `tbl_users`(`username`, `mail`, `contact`, `pass`) VALUES ('".$name."','".$mail."','".$cont."','".$hash_pass."')";
            $result = mysqli_query($con, $ins_user);
            if(!$result)
            {
                echo "Error creating your account";
            }
            else{
                echo "<script>alert('Account registered!');</script>";
            }
            $result = mysqli_query($con, "SELECT * FROM `tbl_users` WHERE `mail`='" . $_POST['mail'] . "'");
            $row = mysqli_num_rows($result);
            if ($row < 0) {
                $ver_link_token = md5($_POST['mail']) . rand(10, 9999);
                $add_user_query = "INSERT INTO `tbl_users`(`username`, `mail`, `contact`, `pass`) VALUES ('" . $name . "','" . $mail . "','" . $cont . "','" . $pass . "')";
                $add_user_res = mysqli_query($con, $add_user_query);
                //$link = "<a href='/verify-email.php?key=" . $_POST['mail'] . "&token=" . $ver_link_token . "'>Click and Verify Email</a>";

                //$to_email = $_POST['mail'];
               // $subject = "Chitrang Studio -- Email Verification";
               // $body = "Click on this link to verify Email" . $link . "";
                //$headers = "From: chitrangstudio123temp@gmail.com";

                /*if (mail($to_email, $subject, $body, $headers)) {
                    echo "Check Your Email box and Click on the email verification link to activate your account";
                } else {
                    echo "Email sending failed";
                }*/
            } else {
                echo "You have already registered with us.";
            }
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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="admin/css/login.css">
    <title>Document</title>
</head>

<body>
    <div class="container" style="margin-top:auto;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-12">
                <div class="login-wrap py-5">
                    <div class="row" style="margin-right:10%;margin-left:10%;width:100%;">
                        <div class="col-md-9 mb-md-0 mb-5">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username: </label>
                                    <input type="text" name="c_name" class="form-control p-1" <?php if (isset($name)) echo "value=" . $name; ?>>
                                    <span><?php if (isset($err_name)) {
                                                echo $err_name;
                                            } ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Mail: </label>
                                    <input type="text" name="mail" class="form-control p-1" <?php if (isset($mail)) echo "value=" . $mail; ?>>
                                    <span><?php if (isset($err_mail) || isset($err_mail_val)) {
                                                echo $err_mail . $err_mail_val;
                                            }
                                            ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Mobile: </label>
                                    <input type="text" name="mob" class="form-control p-1" <?php if (isset($cont)) echo "value=" . $cont; ?>>
                                    <span><?php if (isset($err_contact) || isset($err_contact_val)) {
                                                echo $err_contact . $err_contact_val;
                                            } ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Password: </label>
                                    <input type="password" name="pass" class="form-control p-1" <?php if (isset($pass)) echo "value=" . $pass; ?>>
                                    <span><?php if (isset($err_pass)) {
                                                echo $err_pass;
                                            } ?></span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn form-control btn-primary rounded submit px-3" name="signup" id="signup">Sign Up</button>
                                </div>
                                <div class="w-100 text-center mt-4 text">
                                    <p class="mb-0">Already have an account?</p>
                                    <a href="userlogin.php">Log In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>