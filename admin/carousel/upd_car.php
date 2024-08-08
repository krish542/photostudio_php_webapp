<?php
require "../conn.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
$id = $_GET['upd_id'];
$msg = '';
$result = mysqli_query($con, "SELECT * FROM `tbl_carousel` WHERE `img_car_id` = $id");
$data = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin2.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style>
        input{
            margin: 10px;
        }
    </style>
    <title>Update Carousel Image</title>
</head>

<body>
    <div class="row">
        <div class="col-lg-4 bg-light rounded px-4">
            <p class="text-center text-light p1">Select image to upload</p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $data['img_car_id']; ?>" name="id">
                </div>
                <div class="form-group">
                    <input type="file" value="" name="image" class="form-control p-1" required><img src="<?php echo "../" . $data['img_path'] ?>" style="width: 300px; height: 200px;">
                </div>
                <div class="form-group">
                    <input type="submit" name="update" class="btn btn-danger m-2" value="update image">

                </div>
                <div class="form-group">
                    <p class="text-center text-light"><?= $msg; ?></p>
                </div>
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST['update']))
    {
        $ID = $_POST['id'];
        
        $file_del = $data['img_path'];
        if($file_del)
        {
            //echo $file_del;
            $status = unlink("../".$file_del);
            if($status)
            {
                echo "file deleted!";
            }
            else
            {
                echo "delete unsuccessful";
            }
        }
        else
        {
            echo "file does not exist";
        }
        
        $img_path1 = $_FILES["image"]["tmp_name"];
        $img_name = $_FILES["image"]["name"];
        $img_des = "carousel_img/" . $img_name;
        move_uploaded_file($img_path1, "../carousel_img/".$img_name);

        $query = "UPDATE `tbl_carousel` SET `img_path`='$img_des' WHERE `img_car_id` = $ID";
        $result = mysqli_query($con, $query);
        header("location: ../home.php");
    }
    ?>
</body>

</html>