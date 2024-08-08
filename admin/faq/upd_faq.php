<?php
require "../conn.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
} else {
    $ques_id = $_GET['upd_id'];
    //echo $img_id;
    $result = mysqli_query($con, "SELECT * FROM `tbl_faq` WHERE `ques_id` = $ques_id");
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
    <title>FAQ Update</title>
</head>

<body>
    <div class="row" style="margin-left: 5%;">
        <form action="" method="post" style="width: 50%;">
            <div class="form-group">
                <label>Question: </label>
                <input type="text" name="ques" class="form-control p-1" value="<?php echo $data['ques']; ?>">
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Answer:</label>
                <textarea class="form-control" name="ans" id="exampleFormControlTextarea1" rows="3"><?php echo $data['ans']; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="upd_ques" class="btn btn-warning btn-block" value="Add Question">

            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['upd_ques'])) {
        
        $ques = $_POST['ques'];
        $ans = $_POST['ans'];
        $query = "UPDATE `tbl_faq` SET `ques`='$ques', `ans`='$ans' WHERE `ques_id` = $ques_id";
        $result = mysqli_query($con, $query);
        if(!$result)
        {
            echo "Error: ". mysqli_error($con);
        }
        else{
            header("location: ../faqs.php");
        }
        
    }
    ?>
</body>

</html>