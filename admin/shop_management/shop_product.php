<?php
require "../conn.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: ../index.php");
}
$err_catname = $name = $id = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update_cat'])) {
        if (!empty($_POST['cat_name'])) {
            $name = $_POST['cat_name'];
        }
        $id = $_POST['catid'];
        $upd_cat_query = "UPDATE `tbl_product_cat` SET `prod_cat`='" . $name . "' WHERE `prod_catid` = '" . $id . "'";
        $upd_res = mysqli_query($con, $upd_cat_query);
        if (!$upd_res) {
            echo "Not updated!";
        }
    }
    if (isset($_POST['del_cat'])) {
        $id = $_POST['catid'];
        $del_cat_query = "DELETE FROM `tbl_product_cat` WHERE `prod_catid` = '" . $id . "'";
        $del_cat_res = mysqli_query($con, $del_cat_query);
        if (!$del_cat_res) {
            echo "Cannot delete";
        }
    }
    $catname = "";
    if (isset($_POST['add_cat'])) {
        if (empty($_POST['catname'])) {
            $err_catname = "Please enter category name";
        } else {
            $catname = $_POST['catname'];
        }
        $add_cat_query = "INSERT INTO `tbl_product_cat`(`prod_cat`) VALUES ('" . $catname . "')";
        $add_cat_res = mysqli_query($con, $add_cat_query);
        if (!$add_cat_query) {
            echo "Not added";
        }
    }
    $err_prodname  = "";
    if (isset($_POST['add_prod'])) {
        if (empty($_POST['$err_prodname'])) {
            $err_catname = "Please enter category name";
        } else {
            $catname = $_POST['catname'];
        }
        $add_cat_query = "INSERT INTO `tbl_product_cat`(`prod_cat`) VALUES ('" . $catname . "')";
        $add_cat_res = mysqli_query($con, $add_cat_query);
        if (!$add_cat_query) {
            echo "Not added";
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
    <title>Products</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/admin2.css">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
                    <a href="../admin.php" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="active">
                    <a href="../nav_edit_admin.php" aria-expanded="false" class="dropdown-toggle">
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
                            <a href="../home.php">Home Page</a>
                        </li>
                        <li>
                            <a href="../portfolio.php">Portfolio</a>
                        </li>
                        <li>
                            <a href="../packages.php">Packages</a>
                        </li>
                        <li>
                            <a href="../faqs.php">FAQs</a>
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
                            <a href="shop_product.php">Products</a>
                        </li>
                        <li>
                            <a href="shop_sales.php">Sales</a>
                        </li>
                        <li>
                            <a href="shop_purchases.php">Purchases</a>
                        </li>
                        <li>
                            <a href="shop_users.php">Customers and Users</a>
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
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <h5>Shop Management - Products</h5>
                </div>
            </nav>
            <!-- Main Content 
            <h4>//Product Category</h4>
            //view-->
            <h5>Products:</h5>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-info collapsed pack_det" id="pack_det" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
                                Add Product
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="prodname" class="form-control p-1">
                                    <span><?php if (!empty($err_prodname)) echo $err_prodname; ?></span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Type</label>
                                    </div>
                                    <select class="custom-select" name="prod_type" id="inputGroupSelect01">
                                        <option selected>--Choose Type--</option>
                                        <?php
                                        $sel_type_query = "SELECT * FROM `tbl_product_cat`";
                                        $select_res = mysqli_query($con, $sel_type_query);
                                        while ($sel_row = mysqli_fetch_array($select_res)) {
                                            echo '<option value="' . $sel_row['prod_catid'] . '">' . $sel_row['prod_cat'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea class="form-control" name="prod_desc" rows="3"></textarea>
                                    <span><?php if (!empty($err_proddesc)) echo $err_proddesc; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input type="text" name="prodprice" class="form-control p-1">
                                    <span><?php if (!empty($err_prodprice)) echo $err_prodprice; ?></span>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="rbtn_colorno" checked onclick="disablecolor(this)">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Colors Not Available
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="rbtn_coloryes" onclick="enablecolor(this)">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Colors Available
                                    </label>
                                </div>
                                <select class="form-select" name="sel_color" id="sel_color" multiple aria-label="multiple select example" disabled>
                                    <option value="" selected>Select Colors</option>
                                    <?php
                                    $sel_color_query = "SELECT * FROM `tbl_colors`";
                                    $sel_color_res = mysqli_query($con, $sel_color_query);
                                    while ($color_row = mysqli_fetch_array($sel_color_res)) {
                                        echo '<option value="' . $color_row['color_id'] . '">' . $color_row['color_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <button type="button" name="confirm_colors" onclick="getinput()" class="btn btn-info" id="sel_col">Confirm Colors</button>
                                <input type="hidden" id="colors_list" name="colors_list">
                               
                                <script>
                                    $("#sel_col").click(function() {
                                        var selected = $("#sel_color option:selected").map(function() {
                                            return $(this).text();
                                        }).get().join(',');
                                        console.log(selected);
                                        //$("#colors_list".val(selected));
                                    });

                                    function getinput() {
                                        var count = 0;
                                        for (var i = 0; i < sel_color.selectedOptions.length; i++) {
                                            count++;
                                        }
                                        
                                        for (var i = 0; i < count; i++) {
                                            $("#multicolor_image").append('<label>: </label><input type="file" name="prod_img'+i+'" class="form-control p-1" multiple>');
                                        }
                                    }
                                </script>
                                <div class="multicolor_image" id="multicolor_image"></div>
                                <!--<div class="form-group">
                                    <button type="button" class="btn btn-info btn_sel_col" disabled id="btn_sel_col">Select colors</button>
                                </div>-->
                                <!--
                                                           </div>
                                <div class="nocolor_image" id="nocolor_image" style="display:none">
                                    <div class="form-group">
                                        
                                        <input type="file" name="prod_img[]" class="form-control p-1" multiple>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <input type="submit" name="add_prod" class="btn btn-dark btn-block" value="Add Product">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <h5>Product category:</h5>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-info collapsed pack_det" id="pack_det" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Add Product Category
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Category Name:</label>
                                        <input type="text" name="catname" class="form-control p-1">
                                        <span><?php if (!empty($err_catname)) echo $err_catname; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="add_cat" class="btn btn-dark btn-block" value="Add Category">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    $cat_query = "SELECT * FROM `tbl_product_cat`";
                    $cat_res = mysqli_query($con, $cat_query);
                    while ($row_cat = mysqli_fetch_array($cat_res)) {
                        echo '<ul class="list-group">
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                    ' . $row_cat['prod_cat'] . '
                    <span class="badge badge-primary badge-pill mr-auto p-2">' . $row_cat['cat_items'] . '</span>
                    <form method="POST"><input type="hidden" name="catid" value="' . $row_cat['prod_catid'] . '"><button type="submit" class="btn btn-info" name="del_cat">Delete</button></form>&nbsp
                    <a class="btn btn-info" data-toggle="collapse" href="#collapse' . $row_cat['prod_catid'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">Edit</a>
                    
                    </li>
                    <div class="collapse" id="collapse' . $row_cat['prod_catid'] . '">
                        <div class="card card-body">
                            <form action="" method="post">
                            <input type="hidden" name="catid" class="form-control p-1" value="' . $row_cat['prod_catid'] . '">
                                <div class="form-group">
                                    <label>Category Name:</label>
                                    <input type="text" name="cat_name" class="form-control p-1" value="' . $row_cat['prod_cat'] . '">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update_cat" class="btn btn-dark btn-block" value="Update Category">
                                </div>
                            </form>
                        </div>
                    </div>
              </ul>';
                    }
                    ?>


                    <!--<h4>Settings</h4>
            Create roloes for users and permission management, edit logo, site title, mail settings -->
                </div>
            </div>

            <!-- jQuery CDN - Slim version (=without AJAX) -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <!-- Popper.JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

            <script>
                function enablecolor(rbtn_y) {
                    var sel_color = document.getElementById("sel_color");
                    var sel_col_btn = document.getElementById("btn_sel_col");
                    sel_color.disabled = rbtn_y.checked ? false : true;
                    sel_col_btn.disabled = rbtn_y.checked ? false : true;
                    if (!sel_color.disabled) {
                        sel_color.focus();
                    }
                    var sel_col_btn = document.getElementById("btn_sel_col");
                    document.getElementById("multicolor_image").style.display = "block";
                    document.getElementById("nocolor_image").style.display = "none";
                }

                function disablecolor(rbtn_y) {
                    var sel_color = document.getElementById("sel_color");
                    var sel_col_btn = document.getElementById("btn_sel_col");
                    sel_color.disabled = rbtn_y.checked ? true : false;
                    sel_color_btn.disabled = rbtn_y.checked ? true : false;
                    document.getElementById("multicolor_image").style.display = "none";
                    document.getElementById("nocolor_image").style.display = "block";
                }
            </script>
            <script>
                $(document).ready(function() {
                    $("button.btn_sel_col").click(function() {
                        /*var colors = [];
                        for (var option of document.getElementById('sel_col').options) {
                            if (option.selected) {
                                colors.push(option.value);
                            }
                        }
                        alert("You have selected the colors - " + colors.join(", "));*/
                    });
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                    });
                });
            </script>
</body>

</html>