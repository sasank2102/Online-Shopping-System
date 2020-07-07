<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Cart</title>
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
        </head>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['loggedin'])) {
            $_SESSION['login_err'] = "Login to view the cart!";
            header("location: login.php");
        }
        ?>
        <body>
            <?php require_once 'config.php' ?>;
            <?php include 'navbar.php' ?>
            <?php include 'footer.php' ?>
        
            <?php
            
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $err=0;
                  foreach ($_POST['quantity'] as $key => $val) {
                      if(!is_numeric($val)|| floatval($val)!= intval($val)||intval($val)<0){
                          $err=1;
                          break;
                      }
                  }
                  if(!$err){
            
            if (isset($_POST['checkout'])) {

                $sql = 'select max(sid) as sid from sales';
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
                $sid = $row['sid'];
                $sid = $sid + 1;
                foreach ($_POST['quantity'] as $key => $val) {

                    $sql = 'select quantity from products where pid=' . $key . '';
                    $result = $mysqli->query($sql);
                    $row = $result->fetch_assoc();
                    $old = $row['quantity'];
                    $new = $old - $val;
                    $sql = 'update products set quantity =' . $new . ' where pid=' . $key;
                    $result = $mysqli->query($sql);
                    $sql = 'insert into sales(sid,pid,qty,price) values (' . $sid . ',' . $key . ',' . $val . ',0)';
                    $result = $mysqli->query($sql);
                    $sql = 'select price from products where pid=' . $key;
                    $result = $mysqli->query($sql);
                    $row = $result->fetch_assoc();

                    $sql = 'update sales set price = ' . ($row['price'] * $val) . ' where sid=' . $sid . ' and pid=' . $key;
                    echo $sql;
                    $result = $mysqli->query($sql);
                }

                unset($_SESSION['cart']);
                header("location: success.php");
            }

            if (isset($_POST['update'])) {

                foreach ($_POST['quantity'] as $key => $val) {
                    if ($val <= 0) {
                        unset($_SESSION['cart'][$key]);
                        if (count($_SESSION['cart']) === 0) {
                            unset($_SESSION['cart']);
                        }
                    } else {
                        $_SESSION['cart'][$key]['quantity'] = $val;
                    }
                }
            }
              }
              }
            ?> 

            <div class="container" style="margin-top:50px;">
            
             <?php
                if(isset($err)&&$err){?>
                
                <center><span class="alert-danger">Quantity should be positive integer </span></center>
                
                <?php
                }
                ?>
            <div class="col-xs-6 col-xs-offset-3">
               
                <form method="post" action="cart.php"> 
                    <table class="table table-bordered">
                        <?php if (isset($_SESSION['cart'])) {
                            ?>
                            <tbody>
                                <tr> 
                                    <th>Name</th> 
                                    <th>Quantity</th> 
                                    <th>Price(1 unit)</th> 
                                    <th>Price (ordered quantity)</th> 
                                </tr> 

                                <?php
                                if (session_status() == PHP_SESSION_NONE) {
                                    session_start();
                                }



                                $sql = "SELECT * FROM products WHERE pid IN (";

                                foreach ($_SESSION['cart'] as $id => $value) {
                                    $sql .= $id . ",";
                                }

                                $sql = substr($sql, 0, -1) . ") ORDER BY pname ASC";
                                $result = $mysqli->query($sql);
                                echo '<br>';
                                $totalprice = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $subtotal = $_SESSION['cart'][$row['pid']]['quantity'] * $row['price'];
                                    $totalprice += $subtotal;
                                    ?> 
                                    <tr> 
                                        <td><?php echo $row['pname'] ?></td> 
                                        <td><input type="text" name="quantity[<?php echo $row['pid'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['pid']]['quantity'] ?>" /></td> 
                                        <td><?php echo $row['price'] ?></td> 
                                        <td><?php echo $_SESSION['cart'][$row['pid']]['quantity'] * $row['price'] ?></td> 
                                    </tr> 
                                    <?php
                                }

                                if ($totalprice >= 10000) {
                                    $d = 0.1;
                                } else if ($totalprice >= 5000) {
                                    $d = 0.01;
                                } else {
                                    $d = 0;
                                }
                                ?> <tr> 
                                    <td colspan="4">Total Price: Rs. <?php echo $totalprice ?></td> 
                                </tr>
                                <tr> 
                                    <td colspan="4">Discount: Rs. <?php echo $totalprice*$d; ?></td> 
                                </tr> 
                                <tr> 
                                    <td colspan="4">Net Price: Rs. <?php echo ($totalprice-$totalprice*$d) ?></td> 
                                </tr>
                            </tbody>
                        </table>
                        <br /> 
                        <button type="submit"class="btn btn-primary" name="update">Update Cart</button> 
                        <button type="submit"class="btn btn-primary" name="checkout">Checkout</button> 
                    </form> 
                    <br /> 
                    <p>To remove an item, set it's quantity to 0. </p>
                    
                    <?php
                } else {
                    echo '<div class="alert-info" style="margin-top:30px;">';
                    echo '<p><b>';
                    echo '<center>Cart is Empty</center>';
                    echo '</b></p>';
                    echo '</div>';
                }
                ?>
                    <span class="help-block alert-info"><center><a href="products.php" ><b>Click here to browse more products</b></a></center></span>
                    
            </div>
        </div>

        <!--Footer-->

    </body>
</html>
