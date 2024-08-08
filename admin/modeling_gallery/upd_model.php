<?php
require "../conn.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
else{
    $img_id = $_GET['upd_id'];
//echo $img_id;
$result = mysqli_query($con, "SELECT * FROM `tbl_model_gallery` WHERE `model_id` = $img_id");
$data = mysqli_fetch_array($result);
}


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
    <title>Wedding Photo Update</title>
</head>
<body>
<div class="row">
        <div class="col-lg-4 bg-light rounded px-4">
            <p class="text-center text-light p1">Select image to upload</p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $data['model_id']; ?>" name="id">
                </div>
                <div class="form-group">
                    <input type="file" name="image" class="form-control p-1" value="../<?php echo $data['model_imgpath'] ?>" required><img src="<?php echo "../" . $data['model_imgpath'] ?>" style="width: 300px; height: 200px;">
                </div>
                <div class="form-group">
                    <input type="text" value="<?php echo $data['model_imgalt']; ?>" name="alttxt_upd">
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
        $file_del = $data['model_imgpath'];
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
        $img_alt = $_POST['alttxt_upd'];
        $img_path1 = $_FILES["image"]["tmp_name"];
        $img_name = $_FILES["image"]["name"];
        $img_des = "modeling_gallery/img/" . $img_name;
        move_uploaded_file($img_path1, "../modeling_gallery/img/".$img_name);

        $query = "UPDATE `tbl_model_gallery` SET `model_imgpath`='$img_des', `model_imgalt`='$img_alt' WHERE `model_id` = $img_id";
        $result = mysqli_query($con, $query);
        header("location: ../modeling_editing.php");
    }
    ?>
</body>
</html>