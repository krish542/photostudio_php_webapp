<?php
require "../conn.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
$id = $_GET['del_id'];
//echo $id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    $query2 = "SELECT * FROM `tbl_model_gallery` WHERE `model_id` = $id";
    $res2 = mysqli_query($con, $query2);
    if($res2)
    {
        $row = mysqli_fetch_array($res2);
        $img = $row['model_imgpath'];
        echo $img;
        $status = unlink("../".$img);
        if($status)
        {
            echo "file deleted!";
            //header("location: ../home.php");
        }
        else
        {
            echo "delete unsuccessful";
        }
    }
    $query = "DELETE FROM `tbl_model_gallery` WHERE `model_id` = $id";
    $result = mysqli_query($con, $query);
    if($result)
    {
        echo "<script>alert('Deleted');</script>";
    }
    else
    {
        echo "Deletion unsuccessful";
    }
    header("location: ../modeling_editing.php");
    ?>
</body>
</html>