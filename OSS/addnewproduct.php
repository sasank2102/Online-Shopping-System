

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Add Products</title>
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
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <style>footer {
                position: absolute;  }
            </style>
            <script>


                function url_function(f1) {


                    f1.submit();
                    window.location.search = "?cat=" + $("#cat").val() + "&sub_cat=null";
                }
            </script>
        </head>
        <?php

// Include config file

        function doesnotcontainalpha($s) {
            $c = 0;
            for ($i = 0; $i < strlen($s); $i++) {
                if (ctype_alpha($s[$i])) {
                    $c++;
                    break;
                }
            }
            if ($c) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        require_once 'config.php';

// Define variables and initialize with empty values
        $pname = $price = $category = $sub_cat = $quantity = "";
        $pname_err = $price_err = $category_err = $sub_cat_err = $quantity_err = "";

// Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // Validate username
            if (isset($_GET['pname']))
                if (empty(trim($_GET["pname"]))) {
                    $pname_err = "Please enter a Product Name.";
                } else
                if (preg_match('/[^a-z_\'\s\-0-9]/i', trim($_GET["pname"])) || doesnotcontainalpha($_GET["pname"])) {
                    $pname_err = 'Product name should contain only alphabets,numbers';
                } else {
                    $pname = trim($_GET['pname']);
                }
            // Validate password





            if (isset($_GET['price']))
                if (empty(trim($_GET["price"]))) {
                    $price_err = "Please enter Product price .";
                } else if (!is_numeric($_GET['price']) || floatval($_GET["price"]) <= 0) {
                    $price_err = "Product Price must be numeric and positive .";
                } else {
                    $price = floatval(trim($_GET['price']));
                }

            if (isset($_GET['quantity']))
                if (empty(trim($_GET["quantity"]))) {
                    $quantity_err = "Please enter quantity";
                } else if (!ctype_digit($_GET["quantity"])) {
                    $quantity_err = "Quantity must be positive integer";
                } else {
                    $quantity = intval(trim($_GET['quantity']));
                }

            if (isset($_GET['category']))
                if (empty(trim($_GET["category"]))) {
                    $category_err = "Please enter Category.";
                } else {
                    $category = trim($_GET['category']);
                }

            if (isset($_GET['sub_cat']))
                if (empty(trim($_GET["sub_cat"]))) {
                    $sub_cat_err = "Please enter Sub-Category.";
                } else {
                    $sub_cat = trim($_GET['sub_cat']);
                }







            // Check input errors before inserting in database
            if (isset($_GET['pname']) && isset($_GET['price']) && isset($_GET['category']) && isset($_GET['sub_cat']) && isset($_GET['quantity']) && $_GET['sub_cat'] != 'null' && $_GET['sub_cat'] != 'all')
                if (empty($pname_err) && empty($price_err) && empty($quantity_err) && empty($category_err) && empty($sub_cat_err)) {

                    // Prepare an insert statement
                    $sql = "insert into products(pname,price,quantity,category,sub_category) values (?,?,?,?,?)";
                    if ($stmt = $mysqli->prepare($sql)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt->bind_param("siiss", $pname, $price, $quantity, $category, $sub_cat);

                        // Set parameters
                        // Attempt to execute the prepared statement
                        if ($stmt->execute()) {
                            // Redirect to login page
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            $_SESSION['pname'] = $pname;
                            header("location: addimage.php");
                        } else {
                            echo "Something went wrong. Please try again later.";
                        }
                    }

                    // Close statement
                    $stmt->close();



                    // Close statement
                }

            // Close connection
        }
        ?>
        <body >
<?php include 'footer.php' ?>


            <div class="container"  >
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <h1> ADD PRODUCT </h1>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                        <div class="form-group">
                            <input type="text"  class="form-control" name="pname"  placeholder="Product Name" value="<?php echo $pname; ?>" >
                            <span class="help-block alert-danger"><?php echo $pname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="price" placeholder="Price" value="<?php echo $price; ?>">
                            <span class="help-block alert-danger"><?php echo $price_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="quantity"  placeholder="quantity" value="<?php echo $quantity; ?>" >
                            <span class="help-block alert-danger"><?php echo $quantity_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="cat">Category:</label>

                            <select class="form-control" name="category" id="cat" onchange="url_function(this.form)"  >
                                <option>-</option>
                                <?php
                                $sql = 'select cname from category';

                                $result = $mysqli->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option <?php if (isset($_GET['category']) && $_GET['category'] == $row['cname']) { ?>selected="true" <?php }; ?>value="<?php echo $row['cname']; ?>"><?php echo $row['cname']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="help-block alert-danger"><?php echo $category_err; ?></span>
                        </div>
                        <div class="form-group"> <inp
                                <label for="cat">Sub-Category:</label>

                                <select class="form-control" name="sub_cat" id="sub_cat"   >
                                    <?php
                                    echo '<option value="all">-</option>';
                                    ?>
                                    <?php
                                    if (isset($_GET['category'])) {
                                        $sql = 'select scname from sub_category where cid=(select cid from category where cname="' . $_GET['category'] . '")';

                                        $result = $mysqli->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option <?php if (isset($_GET['sub_cat']) && $_GET['sub_cat'] == $row['scname']) { ?>selected="true" <?php }; ?>value="<?php echo $row['scname']; ?>"><?php echo $row['scname']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <span class="help-block alert-danger"><?php echo $sub_cat_err; ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form></div></div></div>

        <!--Footer-->


        <!--<footer style="position:absolute;bottom:0px;height: 50px;">
            <div class="container" >
              <center>
                  <p>Copyright &copy; Lifestyle Store. All Rights Reserved  |  Contact Us: +91 90000 00000</p>	
              </center>
          </div>
      </footer>
        <!--Footer end-->

    </body>
</html>
