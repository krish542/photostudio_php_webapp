<?php
require "../conn.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}

$pack_id = $_GET['upd_id'];

$err_pack_name = $err_v_price = $err_p_price = $err_p_album_price = $err_p_copy_price = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['add_pack_det'])) {
        $pack_name = $video_price = $video_time = $photo_price = $photo_album_price = $photo_copy_price = "";
        $v_video = $p_photo = $p_album = $p_copy = 0;
        if (empty($_POST['pack_name'])) {
            $err_pack_name = "Please Enter Pack Name";
        } else {
            $pack_name = $_POST['pack_name'];
        }
        //Only Video-----------------------------------------------------------------------------------------------------------
        if (isset($_POST['rbtn_v']) && !isset($_POST['rbtn_p'])) {
            //echo "video checked";
            $v_video = 1;
            if (!isset($_POST['video_price'])) {
                $err_v_price = "Enter Video Pricing";
            } else {
                $video_price = $_POST['video_price'];
            }
            if (!isset($_POST['video_time'])) {
                $err_v_time = "Enter Video Timings";
            } else {
                $video_time = $_POST['video_time'];
            }
            $upd_query = "UPDATE `tbl_packages` SET `pack_name`='" . $pack_name . "',`vdo_avail`='" . $v_video . "',`vdo_price`='" . $video_price . "',`vdo_time`='" . $video_time . "',`pg_avail`='" . $p_photo . "',`pg_price`='" . $photo_price . "',`pb_avail`='" . $p_album . "',`pb_price`='" . $photo_album_price . "',`pc_avail`='" . $p_copy . "',`pc_price`='" . $photo_copy_price . "' WHERE `pack_id`=" . $pack_id . "";
            $result = mysqli_query($con, $upd_query);
            if (!$result) {
                echo "Error:" . mysqli_error($con);
            } else {
                header("location:../packages.php");
            }
        }
        //Only Photo-----------------------------------------------------------------------------------------------------------
        else if (isset($_POST['rbtn_p']) && !isset($_POST['rbtn_v'])) {
            $p_photo = 1;
            if (!isset($_POST['photo_price'])) {
                $err_p_price = "Enter Photography price";
            } else {
                $photo_price = $_POST['photo_price'];
                if (isset($_POST['chkbx_p_album']) && !isset($_POST['chkbx_p_copy'])) {
                    $p_album = 1;
                    if (!isset($_POST['photo_price_album'])) {
                        $err_p_album_price = "Please enter Album Price";
                    } else {
                        $photo_album_price = $_POST['photo_price_album'];
                    }
                } else if (!isset($_POST['chkbx_p_album']) && isset($_POST['chkbx_p_copy'])) {
                    $p_copy = 1;
                    if (!isset($_POST['photo_price_copy'])) {
                        $err_p_album_price = "Please enter Hard Copy Price";
                    } else {
                        $photo_copy_price = $_POST['photo_price_copy'];
                    }
                } else if (isset($_POST['chkbx_p_album']) && isset($_POST['chkbx_p_copy'])) {
                    $p_album = 1;
                    $p_copy = 1;
                    if (!isset($_POST['photo_price_album'])) {
                        $err_p_album_price = "Please enter Album Price";
                    } else {
                        $photo_album_price = $_POST['photo_price_album'];
                    }

                    if (!isset($_POST['photo_price_copy'])) {
                        $err_p_album_price = "Please enter Hard Copy Price";
                    } else {
                        $photo_copy_price = $_POST['photo_price_copy'];
                    }
                }
            }
            $upd_query = "UPDATE `tbl_packages` SET `pack_name`='" . $pack_name . "',`vdo_avail`='" . $v_video . "',`vdo_price`='" . $video_price . "',`vdo_time`='" . $video_time . "',`pg_avail`='" . $p_photo . "',`pg_price`='" . $photo_price . "',`pb_avail`='" . $p_album . "',`pb_price`='" . $photo_album_price . "',`pc_avail`='" . $p_copy . "',`pc_price`='" . $photo_copy_price . "' WHERE `pack_id`=" . $pack_id . "";
            $result = mysqli_query($con, $upd_query);
            if (!$result) {
                echo "Error:" . mysqli_error($con);
            } else {
                header("location:../packages.php");
            }
        }
        //Both Photo and Video-----------------------------------------------------------------------------------------------------------
        else if (isset($_POST['rbtn_v']) && isset($_POST['rbtn_p'])) {
            $v_video = 1;
            $p_photo = 1;
            if (!isset($_POST['video_price'])) {
                $err_v_price = "Enter Video Pricing";
            } else {
                $video_price = $_POST['video_price'];
            }
            if (!isset($_POST['video_time'])) {
                $err_v_time = "Enter Video Timings";
            } else {
                $video_time = $_POST['video_time'];
            }

            if (!isset($_POST['photo_price'])) {
                $err_p_price = "Enter Photography price";
            } else {
                $photo_price = $_POST['photo_price'];
                if (isset($_POST['chkbx_p_album']) && !isset($_POST['chkbx_p_copy'])) {
                    $p_album = 1;
                    if (!isset($_POST['photo_price_album'])) {
                        $err_p_album_price = "Please enter Album Price";
                    } else {
                        $photo_album_price = $_POST['photo_price_album'];
                    }
                } else if (!isset($_POST['chkbx_p_album']) && isset($_POST['chkbx_p_copy'])) {
                    $p_copy = 1;
                    if (!isset($_POST['photo_price_copy'])) {
                        $err_p_album_price = "Please enter Hard Copy Price";
                    } else {
                        $photo_copy_price = $_POST['photo_price_copy'];
                    }
                } else if (isset($_POST['chkbx_p_album']) && isset($_POST['chkbx_p_copy'])) {
                    $p_album = 1;
                    $p_copy = 1;
                    if (!isset($_POST['photo_price_album'])) {
                        $err_p_album_price = "Please enter Album Price";
                    } else {
                        $photo_album_price = $_POST['photo_price_album'];
                    }

                    if (!isset($_POST['photo_price_copy'])) {
                        $err_p_album_price = "Please enter Hard Copy Price";
                    } else {
                        $photo_copy_price = $_POST['photo_price_copy'];
                    }
                }
            }
            $upd_query = "UPDATE `tbl_packages` SET `pack_name`='" . $pack_name . "',`vdo_avail`='" . $v_video . "',`vdo_price`='" . $video_price . "',`vdo_time`='" . $video_time . "',`pg_avail`='" . $p_photo . "',`pg_price`='" . $photo_price . "',`pb_avail`='" . $p_album . "',`pb_price`='" . $photo_album_price . "',`pc_avail`='" . $p_copy . "',`pc_price`='" . $photo_copy_price . "' WHERE `pack_id`=" . $pack_id . "";
            $result = mysqli_query($con, $upd_query);
            if (!$result) {
                echo "Error:" . mysqli_error($con);
            } else {
                header("location:../packages.php");
            }
        } else {
            echo "none selected, Error";
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

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin2.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <title>Document</title>
</head>

<body>
    <?php
    $query = "SELECT * FROM `tbl_packages` WHERE `pack_id`=" . $pack_id . "";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div id="content" style="width: 70%;margin:auto;">
            <form action="" method="post">
                <div class="form-group">
                    <label>Package Name:</label>
                    <input type="text" name="pack_name" class="form-control p-1" value="<?php echo $row['pack_name']; ?>">
                </div>
                <h4>Video Details:</h4>
                <div class="form-check form-switch">
                    <input class="rbtn_v form-check-input" name="rbtn_v" type="checkbox" id="rbtn_v" onclick="enablev(this)" vlaue="rbtn_v" <?php if ($row['vdo_avail'] == 1) echo "checked"; ?>>
                    <label class="form-check-label" for="rbtn_v">Videography available:</label>
                </div>
                <div class="form-group">
                    <label>Video Price:</label>
                    <input type="text" class="form-control p-1" name="video_price" width="20" id="txt_vprice" disabled="disabled" value="<?php echo $row['vdo_price']; ?>">
                </div>
                <div class="form-group">
                    <label>Video timing:</label>
                    <input type="text" class="form-control p-1" name="video_time" width="20" id="txt_vtime" disabled="disabled" value="<?php echo $row['vdo_time']; ?>">
                </div>
                <hr>
                <h4>Photo Details:</h4>
                <div class="form-check form-switch">
                    <input class="rbtn_p form-check-input" name="rbtn_p" type="checkbox" id="rbtn_p" onclick="enablep(this)" <?php if ($row['pg_avail'] == 1) echo "checked"; ?>>
                    <label class="form-check-label" for="rbtn_p">Photography available</label>
                </div>
                <div class="form-group">
                    <label>Photography Price (per day):</label>
                    <input type="text" class="form-control p-1" name="photo_price" width="20" id="txt_pprice" disabled="disabled" value="<?php echo $row['pg_price']; ?>">
                </div>
                <div class="form-check form-switch">
                    <input class="chkbx_p_album form-check-input" name="chkbx_p_album" type="checkbox" id="chkbx_p_album" disabled="disabled" onclick="enableAlbum(this)" <?php if ($row['pb_avail'] == 1) echo "checked"; ?>>
                    <label class="form-check-label" for="rbtn_p">Photobook available</label>
                </div>
                <div class="form-group">
                    <label>Photo Price (per page):</label>
                    <input type="text" class="form-control p-1" name="photo_price_album" width="20" id="txt_pprice_album" disabled="disabled" value="<?php echo $row['pb_price']; ?>">
                </div>
                <div class="form-check form-switch">
                    <input class="chkbx_p_copy form-check-input" name="chkbx_p_copy" type="checkbox" id="chkbx_p_copy" disabled="disabled" onclick="enableCopy(this)" <?php if ($row['pc_avail'] == 1) echo "checked"; ?>>
                    <label class="form-check-label" for="rbtn_p">Photo Hard Copy available</label>
                </div>
                <div class="form-group">
                    <label>Photo Price (per hard copy):</label>
                    <input type="text" class="form-control p-1" name="photo_price_copy" width="20" id="txt_pprice_copy" disabled="disabled" value="<?php echo $row['pc_price']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="add_pack_det" class="btn btn-dark btn-block" value="Update Package">
                </div>
            </form>
        </div>
    <?php
    }
    ?>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
        function enablev(rbtn_v) {

            var txt_vprice = document.getElementById("txt_vprice");
            txt_vprice.disabled = rbtn_v.checked ? false : true;
            if (!txt_vprice.disabled) {
                txt_vprice.focus();
            }

            var txt_vtime = document.getElementById("txt_vtime");
            txt_vtime.disabled = rbtn_v.checked ? false : true;
            if (!txt_vtime.disabled) {
                //txt_vtime.focus();
            }

        }

        function enablep(rbtn_p) {
            var txt_pprice = document.getElementById("txt_pprice");
            txt_pprice.disabled = rbtn_p.checked ? false : true;
            if (!txt_pprice.disabled) {
                txt_pprice.focus();
            }

            var chkbx_p_album = document.getElementById("chkbx_p_album");
            chkbx_p_album.disabled = rbtn_p.checked ? false : true;

            var chkbx_p_copy = document.getElementById("chkbx_p_copy");
            chkbx_p_copy.disabled = rbtn_p.checked ? false : true;
        }

        function enableAlbum(chkbx_p_album) {
            var txt_pprice_album = document.getElementById("txt_pprice_album");
            txt_pprice_album.disabled = chkbx_p_album.checked ? false : true;
        }

        function enableCopy(chkbx_p_copy) {
            var txt_pprice_copy = document.getElementById("txt_pprice_copy");
            txt_pprice_copy.disabled = chkbx_p_copy.checked ? false : true;
        }
    </script>
    <?php

    ?>
</body>

</html>