<?php
require "../conn.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
$ques_id = $_GET['del_id'];
//echo $id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete FAQ</title>
</head>
<body>
    <?php
    
    $query = "DELETE FROM `tbl_faq` WHERE `ques_id` = $ques_id";
    $result = mysqli_query($con, $query);
    if(!$result)
    {
        echo "Error:" . mysqli_error($con);
    }
    else
    {
        header("location: ../faqs.php");
    }
    
    ?>
</body>
</html>