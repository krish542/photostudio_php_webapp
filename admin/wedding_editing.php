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

//-----Wedding Gallery Insert-----
if (isset($_POST['upload_wed'])) {
    $uploaded_images = array();
    $altertxt = $_POST['alttxt'];
    foreach ($_FILES['wed_gallery']['name'] as $key => $val) {
        $upload_dir = "wed_gallery/img/";
        $upload_file = $upload_dir . $_FILES['wed_gallery']['name'][$key];
        $filename = $_FILES['wed_gallery']['name'][$key];
        if (move_uploaded_file($_FILES['wed_gallery']['tmp_name'][$key], $upload_file)) {
            $uploaded_images[] = $upload_file;
            $insert_sql = "INSERT INTO `tbl_wed_gallery` (`wed_imgpath`, `wed_imgalt`) VALUES('wed_gallery/img/" . $filename . "', '" . $altertxt . "')";
            mysqli_query($con, $insert_sql) or die("database error: " . mysqli_error($con));
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
    <title>Admin - Wedding Editing</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin2.css">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
            <h2>Wedding Portfolio Editing</h2>

            <hr>
            <div class="row">
                <div class="col-lg-4 bg-light rounded px-4">
                    <p class="text-center text-light p1">Select Image/s for gallery</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Select Images: </label>
                            <input type="file" name="wed_gallery[]" class="form-control p-1" required multiple>
                        </div>
                        <div class="form-group">
                            <label>Alter Text: </label>
                            <input type="text" name="alttxt" class="form-control p-1">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="upload_wed" class="btn btn-warning btn-block" value="upload image">

                        </div>
                    </form>
                </div>
            </div>
            <table id="table_id1" class="display" style="width: 50%">
                <?php
                echo '<thead>
                <tr>
                    <th>Number</th>
                    <th>Image Path</th>
                    <th>Image</th>
                    <th>Alter Text</th>
                    <th>Actions</th>
                </tr>
            </thead>';
                $query = "SELECT * FROM `tbl_wed_gallery`";
                $result = mysqli_query($con, $query);
                $srno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $srno = $srno + 1;
                    $img_id = $row['wed_id'];
                    echo '
                <tbody>
                <tr>
                    <td>' . $srno . '</td>
                    <td>' . $row['wed_imgpath'] . '</td>
                    <td>' . $row['wed_imgalt'] . '</td>
                    <td><img src="' . $row['wed_imgpath'] . '" width="400px" height = "150px"></td>
                    <td>
                        <a href="editor_admin/index.php#?upd_id=' . $img_id . '&cat=wedding" class="edit btn btn-sm btn-primary" id="' . $row['wed_id'] . '">Edit</a>
                        <a href="wed_gallery/del_wed.php?del_id=' . $row['wed_id'] . '" class="delete btn btn-sm btn-primary" id="' . $row['wed_id'] . '">Delete</a>
                    </td>
                </tr>
                </tbody>
                ';
                }
                ?>
            </table>
            <h4>Preview</h4>
            <div class="">
                <div class="resizable">
                    <iframe src="../wedding.php" height="200" width="300" title="Iframe_wedding"></iframe>
                </div>
            </div>
            <div class="footer-basic">
                <footer>
                    <!--<div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>-->
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="wedding_editing.php">Wedding editing</a></li>
                        <li class="list-inline-item"><a href="prewedding_editing.php">Pre-Wedding editing</a></li>
                        <li class="list-inline-item"><a href="baby_editing.php">Baby editing</a></li>
                        <li class="list-inline-item"><a href="modeling_editing.php">Modeling editing</a></li>
                    </ul>
                    <p class="copyright">Chitrang Studio © 2021</p>
                </footer>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <!-- datatable script -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_id1').DataTable();
        });
    </script>

</body>

</html>