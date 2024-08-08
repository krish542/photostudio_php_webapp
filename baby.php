<?php
require "conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin/css/index_style_gallery.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <title>Document</title>
</head>

<body>
  <!-- Top Navbar-->
  
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
    <?php $logoimg = glob("admin/images/logo/*.png");
    foreach ($logoimg as $image) {
      echo '<img src="' . $image . '" name="studio_logo" width="30" height="50">';
    } ?>

    <a class="navbar-brand" href="index.php">Chitrang Studio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php $query = "SELECT * FROM `tbl_nav`";
        $res = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($res)) {
          if ($row['nav_type'] == "No Dropdown") {
            echo '<li class="nav-item active">
                              <a class="nav-link" href="' . $row['nav_link'] . '">' . $row['nav_name'] . ' <span class="sr-only">(current)</span></a>
                          </li>';
          }

          if ($row['nav_type'] == "Dropdown") {
            echo '
                              <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              ' . $row['nav_name'] . '
                          </a>';
            $parent = $row['nav_id'];
            $ddl_query = "SELECT * FROM `tbl_nav` WHERE `nav_parent_id` = " . $parent . "";
            $res2 = mysqli_query($con, $ddl_query);
            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
            while ($row2 = mysqli_fetch_assoc($res2)) {
              echo '<a class="dropdown-item" href="' . $row2['nav_link'] . '">' . $row2['nav_name'] . '</a>';
            }
            echo '</div></li>';
          }
        }

        ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Packages
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            $query_pack = "SELECT * FROM `tbl_packages`";
            $result_pack = mysqli_query($con, $query_pack);
            while ($row = mysqli_fetch_array($result_pack)) {
              echo '<a class="dropdown-item" href="package.php?pack_id=' . $row['pack_id'] . '">' . $row['pack_name'] . '</a>';
            }
            ?>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Shop
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            $query_prodcat = "SELECT * FROM `tbl_product_cat`";
            $result_prodcat = mysqli_query($con, $query_prodcat);
            while ($row = mysqli_fetch_array($result_prodcat)) {
              echo '<a class="dropdown-item" href="shop.php?cat_id=' . $row['prod_catid'] . '">' . $row['prod_cat'] . '</a>';
            }
            ?>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="" method="POST">
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-user fa-lg" style="color:white;" aria-hidden="true"></i></button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <?php
              if (isset($_POST['logout'])) {
                unset($_SESSION['user_mail']);
                session_destroy();
              }
              if (isset($_SESSION['user_mail'])) {
                echo $_SESSION['user_mail'];
                echo '<div class="modal-footer">
      <form method="POST" name="logout-form" action="index.php" id="logout-form">
      <button type="submit" class="btn btn-secondary logout" name="logout" id="logout">Log out</button>
    </div>
    </form>';
              }
              if (!isset($_SESSION['user_mail'])) {
                echo '
      <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" class="login-form" method="POST">
                      <div class="form-group">
                      <label>E-mail: </label>
                          <div class="icon d-flex align-items-center justify-content-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-user"></span>&nbsp;</div>
                          <input type="text" class="form-control" placeholder="Username" required name="username" 
                          
                      </div>
                      <br>
                      <div class="form-group">
                      <label>Password: </label>
                          <div class="icon d-flex align-items-center justify-content-center">&nbsp;<span class="fa fa-lock"></span>&nbsp;</div>
                          <input type="password" class="form-control" placeholder="Password" required name="pass">
                      </div>
                      <br></br>
                      <div class="form-group d-md-flex">
                          <div class="w-100 text-md-right">
                              <a href="#">Forgot Password</a>
                          </div>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn form-control btn-primary rounded submit px-3" name="login">Log In</button>
                      </div>
                  </form>
                  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <div class="w-100 text-center mt-4 text">
                      <p class="mb-0">Don\'t have an account?</p>
                      <a href="signin.php">Sign Up</a>
                  </div>
        </div>
      </div>
    </div>
  </div>
</form>';
              }
              ?>

            </div>
  </nav>
  <!-- End of Navbar -->
  <h1>Baby Photoshoot</h1>


  <div class="masonry">
    <?php
    require "conn.php";
    $i = 0;
    $query = "SELECT * FROM `tbl_baby_gallery`";
    $result2 = mysqli_query($con, $query);
    if ($result2) {
      while ($row = mysqli_fetch_array($result2)) {
        $image = $row['baby_imgpath'];
        $title = $row['baby_imgalt'];
        $i += 1;

    ?>
        <div class="item">
          <a href="admin/<?php echo $image; ?>">
            <img src="admin/<?php echo $image; ?>" alt="<?php echo $title; ?>">
          </a>
        </div>
    <?php
      }
    } else {
      echo mysqli_error($con);
    }
    ?>
  </div>

  <!-- Footer -->
  <?php
  require "footer.php";
  ?>

</body>

</html>