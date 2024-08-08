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
$err_nav_name = $err_nav_type = $err_nav_parent_id = $err_nav_link = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['add_link'])) {
        $nav_name = $nav_type = $nav_parent_id = $nav_link = "";
        if(empty($_POST['link_name'])){
            $err_nav_name = "Please enter navigation link name to be displayed.";
        }
        else{
            $nav_name = $_POST['link_name'];
        }
        if(empty($_POST['link_type'])){
            $err_nav_type = "Please select the Link type. ";
        }
        else{
            $nav_type = $_POST['link_type'];
            if($nav_type == "Dropdown Item"){
                if(empty($_POST['parent_link']))
                {
                    $err_nav_parent_id = "Please select parent link for the dropdown item. ";
                }
                else{
                    $nav_parent_id = $_POST['parent_link'];
                }
            }
            else{
                $nav_parent_id = "NULL";
            }
        }
        if(empty($_POST['link'])){
            $err_nav_link = "Please enter link. ";
        }
        else{
            $nav_link = $_POST['link'];
        }
        $insert_link = "INSERT INTO `tbl_nav` (`nav_id`, `nav_name`, `nav_type`, `nav_parent_id`, `nav_link`) VALUES (NULL, '".$nav_name."', '".$nav_type."', '".$nav_parent_id."', '".$nav_link."')";
        $ins_res = mysqli_query($con, $insert_link);
        if(!$ins_res){
            echo "Error: " . mysqli_error($con);
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
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <title>Admin -- Nav Bar</title>
</head>

<body>

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
            <h1>Navigation Links</h1>
            <!-- Navigation Links Management -->

            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-info collapsed pack_det" id="pack_det" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Add Link
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Link Name:</label>
                                    <input type="text" name="link_name" class="form-control p-1">
                                    <span><?php if (!empty($err_nav_name)) echo $err_nav_name; ?></span>
                                </div>
                                <h4>Type:</h4>
                                <select name="link_type" id="link_type" onchange="enable_parentmenu(this)">
                                    <option value="">--- Choose Type ---</option>
                                    <option value="Dropdown">Dropdown</option>
                                    <option value="No Dropdown">No Dropdown</option>
                                    <option value="Dropdown Item">Dropdown Item</option>
                                </select>
                                <span><?php if (!empty($err_nav_type)) echo $err_nav_type; ?></span>
                                <div class="form-group">
                                <h5>Parent Link:</h5>
                                    <select name="parent_link" id="parent_link" disabled="disabled">
                                        <option value="">--- Choose Parent Link ---</option>
                                        <?php  
                                            $parent_list_query = "SELECT `nav_name`,`nav_id` FROM `tbl_nav` WHERE `nav_type` = 'Dropdown'";
                                            $res_parent_list = mysqli_query($con, $parent_list_query);
                                            while($row3 = mysqli_fetch_assoc($res_parent_list))
                                            {
                                                echo '<option value="'.$row3['nav_id'].'">'.$row3['nav_name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <span><?php if (!empty($err_nav_parent_id)) echo $err_nav_parent_id; ?></span>
                                </div>
                                <div class="form-group">
                                    <h4>Link:</h4>
                                    <input type="text" class="form-control p-1" name="link" width="20" id="link">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="submit" name="add_link" class="btn btn-dark btn-block" value="Add Link">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div style="width: 90%; overflow-x:auto;">
                    <table id="table_nav" class="display">
                        <?php
                        echo '<thead>
                <tr>
                    <th>Name</th>
                    <th>Link Type</th>
                    <th>Parent Link</th>
                </tr>
            </thead>';
                        $query = "SELECT * FROM `tbl_nav` ORDER BY `nav_parent_id`";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['nav_parent_id'] != 0) {
                                $par = $row['nav_parent_id'];
                                $parent_query = "SELECT `nav_name` from `tbl_nav` WHERE `nav_id` = " . $par . "";
                                $res2 = mysqli_query($con, $parent_query);
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $parent_field = $row2['nav_name'];
                                }
                            } else {
                                $parent_field = "NULL";
                            }


                            echo '
                <tbody>
                <tr>
                    <td>' . $row['nav_name'] . '</td>
                    <td>' . $row['nav_type'] . '</td>
                    <td>' . $parent_field . '</td
                </tr>
                </tbody>
                ';
                        }
                        ?>
                      <tbody>
                <tr>
                    <td>Packages</td>
                    <td>Dropdown</td>
                    <td>NULL</td>
                </tr>
                </tbody>  
                    </table>
                </div>

                <!-- Logo edit -->
                <p>Logo Image<br></p>
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">Upload new image</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!-- to upload image enctype="multipart/form-data" is necessary  -->
                                <form action="" class="login-form" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Photo:</label>
                                        <input type="file" name="image" class="form-control p-1" required>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn form-control btn-primary rounded submit px-3 upd_logo" id="upd_logo" name="upd_logo">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Preview of the Navigation bar at homepage-->
                <hr>
                <!-- Sort -->
                <h4>Sort Items</h4>
                        
                <hr>
                <h4>Preview</h4>
                <?php require "navigation_bar.php"; ?>

                <?php
                // UPDATING LOGO IMAGE - DELETE ORIGINAL FROM FOLDER AND ADD NEW IMAGE TO THE DESTINATION FOLDER
                if (isset($_POST['upd_logo'])) {
                    //deleting previous files
                    $folder_path = "images/logo";
                    $files = glob($folder_path . '/*');
                    foreach ($files as $file) {
                        if (is_file($file))
                            unlink($file);
                    }


                    $target_dir = "images/logo/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $upp_err = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    //allow only certain file types
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        echo "Please upload only JPG, JPEG OR PNG file";
                        $upp_err = 0;
                    }
                    if ($upp_err == 0) {
                        echo "Sorry file was not uploaded";
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            echo "<script>alert('File " . basename($_FILES["image"]["name"]) . " has been uploaded');</script>";
                        } else {
                            echo "Sorry there was an error uploading your file!";
                        }
                    }
                }
                ?>

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
                        $('#table_nav').DataTable();
                    });
                </script>
                <script>
                    function enable_parentmenu(link_type) {

                        var ddl_type = document.getElementById("link_type");
                        var sel_val = ddl_type.options[ddl_type.selectedIndex].value;
                        var ddl_parent = document.getElementById("parent_link");
                        ddl_parent.disabled = sel_val == "Dropdown Item" ? false : true;
                        if (!ddl_parent.disabled) {
                            ddl_parent.focus();
                        }
                    }
                </script>
</body>

</html>