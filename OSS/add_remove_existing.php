<!DOCTYPE html>
<!--

-->
<html>
    <head>
        <title>Products</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Custom CSS -->
        <link href="css/index.css" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="index.css" type="text/css"/>

        <link rel="stylesheet" href="index.css" type="text/css"/>
        <link rel="stylesheet" href="index.css" type="text/css">

        <!-- jQuery library -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('.dropdown-submenu a.test').on("click", function (e) {
                    $(this).next('ul').toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
            });


        </script>
        <style>

            .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu .dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -1px;
            }
        </style>

    </head>




    <?php
    require_once 'config.php';
    ?>
    <body>


        <?php include 'navbar_prod.php' ?>
        <?php include 'footer.php' ?>
        <div class="container">
            <div class="jumbotron">
                <h1>Welcome to our Lifestyle Store!</h1>
                <p>We have the best cameras,watches and shirts for you.No need to hunt around, we have all in one place.</p>
            </div><hr>






            <div class="row text-center">
                <?php
                if (isset($_GET['category']) && isset($_GET['sub_category'])) {
                    $sql = 'select * from products where category="' . $_GET['category'] . '"and sub_category="' . $_GET['sub_category'] . '"';
                } else {
                    $sql = 'select * from products';
                }
                $result = $mysqli->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-3 col-sm-6">';


                    echo '<div class="thumbnail">';
                    echo '  <img src=' . $row['img'] . ' alt="">';
                    echo '<div class="caption">';
                    echo '<h3>' . $row['pname'] . '</h3>';
                    echo '<p>Price:Rs.' . $row['price'] . '</p>';
                    echo '<p>Available Qty: '.$row['quantity'].'</p>';

                    echo'<a href="edit_product.php?id=' . $row['pid'] . '"><button  class="btn btn-primary btn-block">Edit Product Details</button></a>';
                    echo'<a href="add_remove_existing.php?action=remove&id=' . $row['pid'] . '"><button  class="btn btn-primary btn-block">Remove Product</button></a>';
                    echo'<a href="add_quantity.php?id=' . $row['pid'] . '"><button  class="btn btn-primary btn-block">Add quantity</button></a>';
                    echo ' </div>';
                    echo'</div>';
                    



                    echo '</div>';
                }
                ?>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == "remove") {

                    $id = intval($_GET['id']);

                    $sql="delete from products where pid=".$_GET['id'];
                }
                
                
                
                ?>


            </div>

        </div>
        <!--Footer
      <footer>
          <div class="container">
              <center>
                  <p>Copyright &copy; Lifestyle Store. All Rights Reserved  |  Contact Us: +91 90000 00000</p>	
              </center>
          </div>
      </footer>
        <!--Footer end-->
    </body>
</html>
