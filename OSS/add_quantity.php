<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Login Page</title>
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
        <style>
            .row_style{
                margin-top: 10px;
            }
           footer {
          position: absolute;  }
        
        </style>
    </head>
    <?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $_POST['id']=$_GET['id'];
}
  $qty_err="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    // Check if username is empty
    if(empty(trim($_POST["qtyadd"]))){
        $qty_err = 'Please enter quantity to add.';
    } else{
        $qtyadd = trim($_POST["qtyadd"]);
    }
    
    // Check if password is empty
    
    
    // Validate credentials
    if(empty($qty_err)){
        // Prepare a select statement
        $sql = "SELECT quantity from products where pid=".$_POST['id'];
        $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $sql="update products set quantity=".($row['quantity']+$_POST['qtyadd'])." where pid=".$_POST['id'];
        $mysqli->query($sql);
        
        
        
        // Close statement
      
    }
    
    // Close connection
    $mysqli->close();
}
?>
    <body>
        <?php include 'footer.php' ?>
        
        
       
            
        
        
        <div class="container">
            <div class="row row_style">
                 <div class="col-xs-4 col-xs-offset-4">
                   
                       
                     <center> <h3>Add Quantity</h3></center>
                        
                        
                            
                            <!--<button class="btn btn-primary">Demo</button>-->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group">
                            <input type="number"  class="form-control" name="qtyadd"  placeholder="Quantity to add"  >
                            <span class="help-block  alert-danger"><?php echo $qty_err; ?></span>
                        </div>
                                
                        
                                <button type="submit" class="btn btn-primary">Add Quantity</button><br><br>
                    </form>
                       
                        
                </div>
            </div>
        </div>
          <!--Footer-->
        
        <!--Footer end-->
    </body>
</html>
