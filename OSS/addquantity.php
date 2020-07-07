<!DOCTYPE html>
<!--

-->

    <head>
        <title>Add Quantity</title>
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
                       $('.dropdown-submenu ul').hide();
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
    ob_start();
    ?>
    
    <body>


        <?php include 'navbar_quantity.php' ?>
        <?php include 'footer.php' ?>
        <div class="container">
            <div class="jumbotron" style="color:blue">
                <h2><centre>Choose products to add Quantity</centre></h2>
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


                    echo '<a href="addquantity.php?action=add&id=' . $row['pid'] . '&qty=' . $row['quantity'] . '" ><div class="thumbnail">';
                    echo '  <img src=' . $row['img'] . ' alt="">';
                    echo '<div class="caption">';
                    echo '<h3>' . $row['pname'] . '</h3>';
                    echo '<p>Price:Rs.' . $row['price'] . '</p>';
                    echo '<p>Quantity : ' . $row['quantity'] . '</p>';
                    
                    echo '<a href="addunits.php?action=addq&id=' . $row['pid'] . '&qty=' . $row['quantity'] . '" class="btn btn-danger btn-lg active" method="get">Add Quantity';
                    
                    
                  echo '</div>';
                    echo'</div>';
                    echo'</a>';



                    echo '</div>';
                }
                ?>
               
               
       
               
               
                </div>

        </div>
    
    </body>
</html>