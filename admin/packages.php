<?php
require "conn.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location: index.php");
}
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

            $insert = "INSERT INTO `tbl_packages`(`pack_name`, `vdo_avail`, `vdo_price`, `vdo_time`, `pg_avail`, `pg_price`, `pb_avail`, `pb_price`, `pc_avail`, `pc_price`) VALUES ('" . $pack_name . "','" . $v_video . "','" . $video_price . "','" . $video_time . "','" . $p_photo . "','" . $photo_price . "','" . $p_album . "','" . $photo_album_price . "','" . $p_copy . "','" . $photo_copy_price . "')";
            $result = mysqli_query($con, $insert);
            if (!$result) {
                echo "error" . mysqli_error($con);
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
            $insert = "INSERT INTO `tbl_packages`(`pack_name`, `vdo_avail`, `vdo_price`, `vdo_time`, `pg_avail`, `pg_price`, `pb_avail`, `pb_price`, `pc_avail`, `pc_price`) VALUES ('" . $pack_name . "','" . $v_video . "','" . $video_price . "','" . $video_time . "','" . $p_photo . "','" . $photo_price . "','" . $p_album . "','" . $photo_album_price . "','" . $p_copy . "','" . $photo_copy_price . "')";
            $result = mysqli_query($con, $insert);
            if (!$result) {
                echo "error" . mysqli_error($con);
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

                $insert = "INSERT INTO `tbl_packages`(`pack_name`, `vdo_avail`, `vdo_price`, `vdo_time`, `pg_avail`, `pg_price`, `pb_avail`, `pb_price`, `pc_avail`, `pc_price`) VALUES ('" . $pack_name . "','" . $v_video . "','" . $video_price . "','" . $video_time . "','" . $p_photo . "','" . $photo_price . "','" . $p_album . "','" . $photo_album_price . "','" . $p_copy . "','" . $photo_copy_price . "')";
                $result = mysqli_query($con, $insert);
                if (!$result) {
                    echo "error" . mysqli_error($con);
                }
            }
        } else {
            echo "none selected, show error";
        }

        //echo $_POST['rbtn_v'];

        //echo $pack_name;
        //echo $video_price;
        //echo $video_time;

        //echo $_POST['rbtn_p'];
        /*$sql = "INSERT INTO `tbl_carousel`( `img_path`) VALUES ('$path')";
        $result = mysqli_query($con, $sql);
    
        if ($result) {
            
        } else{
    
        }*/
    }
}
// ----- Adding Package and Its Details -----

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
    <title>Admin -- Packages</title>
</head>

<body style="overflow-x: hidden;">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Studio Admin Panel</h3>
                <strong>CS</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="admin.php" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Home
                    </a>

                </li>

                <li class="active">
                    <a href="nav_edit_admin.php" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-bars"></i>
                        Navigation Links
                    </a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Pages
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="home.php">Home Page</a>
                        </li>
                        <li>
                            <a href="portfolio.php">Portfolio</a>
                        </li>
                        <li>
                            <a href="packages.php">Packages</a>
                        </li>
                        <li>
                            <a href="faqs.php">FAQs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-cart-plus"></i>
                        Shop Management
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu2">
                        <li>
                            <a href="shop_management/shop_product.php">Products</a>
                        </li>
                        <li>
                            <a href="shop_management/shop_product.php">Sales</a>
                        </li>
                        <li>
                            <a href="shop_management/shop_purchases.php">Purchases</a>
                        </li>
                        <li>
                            <a href="shop_management/shop_users.php">Customers and Users</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <form method="post">
                        <button name="logout" class="logout">Log Out</button>
                    </form>
                </li>
            </ul>
        </nav>


        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!--<span>Toggle Sidebar</span>-->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <!--<div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                        </ul>
                    </div>-->
                </div>
            </nav>
            <!-- Main Content -->
            <h2>Edit Package Details</h2>

            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-info collapsed pack_det" id="pack_det" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Add Package
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Package Name:</label>
                                    <input type="text" name="pack_name" class="form-control p-1">
                                    <span><?php if (!empty($err_pack_name)) echo $err_pack_name; ?></span>
                                </div>
                                <h4>Video Details:</h4>
                                <div class="form-check form-switch">
                                    <input class="rbtn_v form-check-input" name="rbtn_v" type="checkbox" id="rbtn_v" onclick="enablev(this)" vlaue="rbtn_v" <?php if (isset($_POST['rbtn_v']) && $_POST['rbtn_v'] == "rbtn_v") echo "checked"; ?>>
                                    <label class="form-check-label" for="rbtn_v">Videography available:</label>
                                </div>
                                <div class="form-group">
                                    <label>Video Price:</label>
                                    <input type="text" class="form-control p-1" name="video_price" width="20" id="txt_vprice" disabled="disabled">
                                    <span><?php if (!empty($err_v_price)) echo $err_v_price; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Video timing:</label>
                                    <input type="text" class="form-control p-1" name="video_time" width="20" id="txt_vtime" disabled="disabled">
                                </div>
                                <hr>
                                <h4>Photo Details:</h4>
                                <div class="form-check form-switch">
                                    <input class="rbtn_p form-check-input" name="rbtn_p" type="checkbox" id="rbtn_p" onclick="enablep(this)">
                                    <label class="form-check-label" for="rbtn_p">Photography available</label>
                                </div>
                                <div class="form-group">
                                    <label>Photography Price (per day):</label>
                                    <input type="text" class="form-control p-1" name="photo_price" width="20" id="txt_pprice" disabled="disabled">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="chkbx_p_album form-check-input" name="chkbx_p_album" type="checkbox" id="chkbx_p_album" disabled="disabled" onclick="enableAlbum(this)">
                                    <label class="form-check-label" for="rbtn_p">Photobook available</label>
                                </div>
                                <div class="form-group">
                                    <label>Photo Price (per page):</label>
                                    <input type="text" class="form-control p-1" name="photo_price_album" width="20" id="txt_pprice_album" disabled="disabled">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="chkbx_p_copy form-check-input" name="chkbx_p_copy" type="checkbox" id="chkbx_p_copy" disabled="disabled" onclick="enableCopy(this)">
                                    <label class="form-check-label" for="rbtn_p">Photo Hard Copy available</label>
                                </div>
                                <div class="form-group">
                                    <label>Photo Price (per hard copy):</label>
                                    <input type="text" class="form-control p-1" name="photo_price_copy" width="20" id="txt_pprice_copy" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="add_pack_det" class="btn btn-dark btn-block" value="Add Package">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Package details table -->
            <div style="width:80vw; overflow-x:auto;">
                <table id="table_id" class="display">
                    <?php
                    echo "<thead>
                <tr>
                    <th>Number</th>
                    <th>Package Name</th>
                    <th>Video Availability</th>
                    <th>Video Price</th>
                    <th>Video Time</th>
                    <th>Photography Availability</th>
                    <th>Photography Price</th>
                    <th>Photobook Availability</th>
                    <th>Photobook Price</th>
                    <th>Photo Hard Copy Availability</th>
                    <th>Photo Hard Copy Price</th>
                    <th>Actions</th>
                </tr>
            </thead>";
                    $query = "SELECT * FROM `tbl_packages`";
                    $result = mysqli_query($con, $query);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $srno = $srno + 1;
                        $pack_id = $row['pack_id'];
                        if ($row['vdo_avail'] == 1) {
                            $video_avail = '<i class="fas fa-check-circle"></i>';
                        } else {
                            $video_avail = '<i class="fas fa-times-circle"></i>';
                        }
                        if ($row['vdo_price'] != "") {
                            $vdo_price = $row['vdo_price'];
                        } else {
                            $vdo_price = '<i class="fas fa-window-minimize"></i>';
                        }
                        if ($row['vdo_time'] != "") {
                            $vdo_time = $row['vdo_time'];
                        } else {
                            $vdo_time = '<i class="fas fa-window-minimize"></i>';
                        }
                        if ($row['pg_avail'] == 1) {
                            $pg_avail = '<i class="fas fa-check-circle"></i>';
                        } else {
                            $pg_avail = '<i class="fas fa-times-circle"></i>';
                        }
                        if ($row['pg_price'] != "") {
                            $pg_price = $row['pg_price'];
                        } else {
                            $pg_price = '<i class="fas fa-window-minimize"></i>';
                        }
                        if ($row['pb_avail'] == 1) {
                            $pb_avail = '<i class="fas fa-check-circle"></i>';
                        } else {
                            $pb_avail = '<i class="fas fa-times-circle"></i>';
                        }
                        if ($row['pb_price'] != "") {
                            $pb_price = $row['pb_price'];
                        } else {
                            $pb_price = '<i class="fas fa-window-minimize"></i>';
                        }
                        if ($row['pc_avail'] == 1) {
                            $pc_avail = '<i class="fas fa-check-circle"></i>';
                        } else {
                            $pc_avail = '<i class="fas fa-times-circle"></i>';
                        }
                        if ($row['pc_price'] != "") {
                            $pc_price = $row['pc_price'];
                        } else {
                            $pc_price = '<i class="fas fa-window-minimize"></i>';
                        }
                        echo '
                <tbody>
                <tr>
                    <td>' . $srno . '</td>
                    <td>' . $row['pack_name'] . '</td>
                    <td>' . $video_avail . '</td>
                    <td>' . $vdo_price . '</td>
                    <td>' . $vdo_time . '</td>
                    <td>' . $pg_avail . '</td>
                    <td>' . $pg_price . '</td>
                    <td>' . $pb_avail . '</td>
                    <td>' . $pb_price . '</td>
                    <td>' . $pc_avail . '</td>
                    <td>' . $pc_price . '</td>
                    <td>
                        <a href="pack/upd_pack.php?upd_id=' . $row['pack_id'] . '" class="edit btn btn-sm btn-primary" id="' . $row['pack_id'] . '">Edit</a>
                        <a href="pack/del_pack.php?del_id=' . $row['pack_id'] . '" class="delete btn btn-sm btn-primary" id="' . $row['pack_id'] . '">Delete</a>
                    </td>
                </tr>
                </tbody>
                ';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- DataTable JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
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
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
</body>
</html>