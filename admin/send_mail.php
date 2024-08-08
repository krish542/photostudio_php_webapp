<?php
require "conn.php";


session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
} else {
    $msg = $err_msg = "";
    $msg_id = $_GET['msg_id'];
    $result = mysqli_query($con, "SELECT * FROM `tbl_msg` WHERE `msg_id` = $msg_id");
    $data = mysqli_fetch_array($result);
    if (isset($_POST['send'])) {
        $msg = $_POST['text'];
        //$txt = "Dear ".$data['name']."
        //\nThank you for contacting us and your inquiry regarding our services. In response to your inquiry, please find attached in this email. \n".$msg. "\nWe hope that the details mentioned were useful to you. Feel free to contact us for any further queries. ";
        $to_email = $data['mail'];
        $subject = "Thanks for Contacting Chitrang Studio";
        $body = $msg;
        $headers = "From: chitrangstudio123temp@gmail.com";

        echo $msg;
        /*if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}*/
    }
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

    <title>Send mail</title>
</head>

<body style="overflow: hidden;">
    <div class="row">
        <div class="col-lg-4 bg-light rounded px-4">
            <form action="" method="POST">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $data['msg_id']; ?>" name="id">
                </div>
                <div class="form-group">
                    <textarea hidden class="form-control" id="" rows="1" readonly><?php echo $data['mail']; ?></textarea>
                </div>
                <div class="form-group">
                    <textarea hidden class="form-control" id="" rows="1" readonly><?php echo $data['name']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Subject:</label>
                    <textarea class="form-control" id="" rows="1" readonly><?php echo $data['sub']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Message:</label>
                    <textarea class="form-control" id="" rows="5" readonly><?php echo $data['msg']; ?></textarea>
                </div>
                <div class="form-group">
                    <textarea class="text form-control" name="text" id="text" rows="5">Dear <?php //echo $data['name']; ?> ,
                    Thank you for contacting us and your inquiry regarding our services. In response to your inquiry, please find attached in this email.

                    We hope that the details mentioned were useful to you. Feel free to contact us for any further queries. 
                    Yours sincerely, 
                    Chitrang Studio.
                </textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="send" class="btn btn-danger m-2" value="Send Message">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<!--Dear <?php //echo $data['name']; ?> ,
                    Thank you for contacting us and your inquiry regarding our services. In response to your inquiry, please find attached in this email.

                    We hope that the details mentioned were useful to you. Feel free to contact us for any further queries. 
                    Yours sincerely, 
                    Chitrang Studio.-->