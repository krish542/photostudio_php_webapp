<?php
require "conn.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}
?>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: index.php");
}

//-----Carousel insert-----

$msg = '';
if (isset($_POST['upload'])) {
    $image = $_FILES['image']['name'];
    $path = 'carousel_img/' . $image;

    $sql = "INSERT INTO `tbl_carousel`( `img_path`) VALUES ('$path')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $msg = 'Image uploaded';
    } else
        $msg = "image upload failed";
}

//-----Gallery Insert-----
if(isset($_POST['upload_gal']))
{
    $uploaded_images = array();
    $altertxt = $_POST['alttxt'];
    foreach($_FILES['image_gallery']['name'] as $key=>$val){        
        $upload_dir = "home_gallery_img/";
        $upload_file = $upload_dir.$_FILES['image_gallery']['name'][$key];
        $filename = $_FILES['image_gallery']['name'][$key];
        if(move_uploaded_file($_FILES['image_gallery']['tmp_name'][$key],$upload_file)){
            $uploaded_images[] = $upload_file;
            $insert_sql = "INSERT INTO `tbl_homegallery` (`hgallery_path`, `hgallery_alttext`) VALUES('home_gallery_img/".$filename."', '".$altertxt."')";
            mysqli_query($con, $insert_sql) or die("database error: ". mysqli_error($con));
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
    <title>Home Page - Editing</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin2.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
</head>

<body style="overflow-x: auto;">

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
            <h2>Home Page</h2>
            <!-------------------Carousel-------------------------------- -->
            <h4>Carousel</h4>
            <div class="row">
                <div class="col-lg-4 bg-light rounded px-4">
                    <p class="text-center text-light p1">Select image to upload</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="image" class="form-control p-1" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="upload" class="btn btn-warning btn-block" value="upload image">

                        </div>
                        <div class="form-group">
                            <p class="text-center text-light"><?= $msg; ?></p>
                        </div>
                    </form>
                </div>
            </div>
            <div style="width:80%; overflow:auto;">
            <table id="table_id" class="display">
                <?php
                echo "<thead>
                <tr>
                    <th>Number</th>
                    <th>Image Path</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>";
                $query = "SELECT * FROM `tbl_carousel`";
                $result = mysqli_query($con, $query);
                $srno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $srno = $srno + 1;
                    $img_id = $row['img_car_id'];
                    echo '
                <tbody>
                <tr>
                    <td>' . $srno . '</td>
                    <td>' . $row['img_path'] . '</td>
                    <td><img src="' . $row['img_path'] . '" width="400px" height = "150px"></td>
                    <td>
                        <a href="carousel/upd_car.php?upd_id=' . $img_id . '" class="edit btn btn-sm btn-primary" id="' . $row['img_car_id'] . '">Edit</a>
                        <a href="carousel/del_car.php?del_id=' . $row['img_car_id'] . '" class="delete btn btn-sm btn-primary" id="' . $row['img_car_id'] . '">Delete</a>
                    </td>
                </tr>
                </tbody>
                ';
                }
                ?>
            </table>
            </div>
            <!-------------------------Gallery-------------------------------------- -->
            <hr>
            <h4>Gallery</h4>

            <div class="row">
                <div class="col-lg-4 bg-light rounded px-4">
                    <p class="text-center text-light p1">Select Image/s for gallery</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Select Images: </label>
                            <input type="file" name="image_gallery[]" class="form-control p-1" required multiple>
                        </div>
                        <div class="form-group">
                            <label>Alter Text: </label>
                            <input type="text" name="alttxt" class="form-control p-1">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="upload_gal" class="btn btn-warning btn-block" value="upload image">

                        </div>
                    </form>
                </div>
            </div>
            <div style="width:80%; overflow:auto;">
            <table id="table_id2" class="display" style="width: 50%">
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
                $query = "SELECT * FROM `tbl_homegallery`";
                $result = mysqli_query($con, $query);
                $srno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $srno = $srno + 1;
                    $img_id = $row['homegallery_id'];
                    echo '
                <tbody>
                <tr>
                    <td>' . $srno . '</td>
                    <td>' . $row['hgallery_path'] . '</td>
                    <td>' . $row['hgallery_alttext'] . '</td>
                    <td><img src="' . $row['hgallery_path'] . '" width="400px" height = "150px"></td>
                    <td>
                        <a href="home_gallery/upd_hgal.php?upd_id=' . $img_id . '" class="edit btn btn-sm btn-primary" id="' . $row['homegallery_id'] . '">Edit</a>
                        <a href="home_gallery/del_hgal.php?del_id=' . $row['homegallery_id'] . '" class="delete btn btn-sm btn-primary" id="' . $row['homegallery_id'] . '">Delete</a>
                    </td>
                </tr>
                </tbody>
                ';
                }
                ?>
            </table>
            </div>
            <!--<hr><br>
            * Specialities
            <hr><br>
            * offers
            <hr><br>
            * effects, format
            -->
            <div class="resizable">
                <iframe src="../index.php" height="200" width="300" title="Iframe Example"></iframe>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Sidebar Toggle Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <!-- IFrame resizing Script -->
    <script>
        document.addEventListener('DataPageReady', function(event) {
            $(".content").resizable({
                animate: true,
                animateEasing: 'swing',
                animateDuration: 500
            });
        });
    </script>
    <!-- datatable script -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
    <!-- datatable script -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_id2').DataTable();
        });
    </script>

</body>

</html>