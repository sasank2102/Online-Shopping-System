<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <title>Add Units</title>
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
// Include config file
require_once 'config.php';
ob_start(); 


$quantity=0;


if($_SERVER["REQUEST_METHOD"] == "POST"){
  $quantity = (int)$_POST['quantity'];
  $id=(int)$_POST['id'];
  $qty=(int)$_POST['qty'];
  
}

if($quantity>0)
            {
         
             $new=$quantity+$qty;
              
              $sql='update products set quantity ='.$new.' where pid='.$id;
              
            if (mysqli_query($mysqli, $sql)) 
             {
            echo'Quantity updated';
            echo'redirectng to admin page';
           header('location:adminpage.php');
              } 
              else {
            echo "Error updating record: " . mysqli_error($mysqli);
                    }

mysqli_close($mysqli);

            }

?>
    
      <body>
       
        <?php include 'footer.php' ?>
        <?php include 'navbar.php' ?>
         
         <div class="container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
    <h1> Enter Units to be added </h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  

           <div class="form-group">
 
    <input type="text"  class="form-control" id="add" name="quantity"  placeholder="Quantity" value="<?php echo $quantity; ?>" >
           
              </div>    
                     <?php
                     
                    if (isset($_GET['action']) && $_GET['action'] == "addq") {

                    $id = (int)$_GET['id'];
                    $qty = (int)$_GET['qty'];
                    
                    echo'<div class="form-group">'
                    . '<input   type="hidden" class="form-control" id="add" name="id"  value= "'.$id.'" >'
                            . '</div>';
                    echo'<div class="form-group">'
                    . '<input   type="hidden" class="form-control" id="add" name="qty" value= "'.$qty.'">'
                            . '</div>';
                    }
                       ?>
                        
                    
                        
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>  </div> </div> </div>
          
          <?php
          $_SESSION['added']=True;
          ?>
               <!--Footer end-->
    </body>
</html>




