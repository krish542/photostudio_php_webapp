<?php
require "../conn.php";

$pack_id = $_GET['del_id'];

$del_query = "DELETE FROM `tbl_packages` WHERE `pack_id`=".$pack_id."";
$result = mysqli_query($con, $del_query);
if(!$result){
    echo "Error: ". mysqli_error($con);
}
else{
    header("location: ../packages.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>del_pack</title>
</head>
<body>
    
</body>
</html>