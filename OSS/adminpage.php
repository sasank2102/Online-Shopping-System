<!DOCTYPE html>
<html lang="en">
    <head>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome | Life Style Store</title>
        <!-- Custom CSS -->
        <link href="css/index.css" rel="stylesheet">
        
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="index.css" type="text/css"/>

        <link rel="stylesheet" href="index.css" type="text/css"/>
        <link rel="stylesheet" href="index.css" type="text/css">
         <link rel="stylesheet" href="w3.css">




        <!-- jQuery library -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        
         
        
        <?php include 'navbar_admin.php' ?>
        
        
  <div class="w3-sidebar w3-bar-block w3-light-grey w3-card-2" style="width:24.5%">
     <a href="#" class="w3-bar-item w3-button"></a>
  <a href="addquantity.php" class="w3-bar-item w3-button">Add Quantity</a> 
  <a href="addnewproduct.php" class="w3-bar-item w3-button">Add New Product</a> 
  <a href="addcategory.php" class="w3-bar-item w3-button">Add Category</a> 
  <a href="removecategory.php" class="w3-bar-item w3-button">Remove Category</a> 
   <a href="removeproduct.php" class="w3-bar-item w3-button">Remove Product</a> 
      <a href="charts.php?cat=all" class="w3-bar-item w3-button">Sales Analysis</a>
     


</div>
      

    

<div style="margin-left:24%">

<div class="w3-container">
  <div class="w3-content w3-section" style="max-width:100%" style="max-height:100%">
      <!--<img class="mySlides" src="watch-2.jpg" style="width:100%" >-->
      <img class="mySlides" src="camera.jpg" style="width:100%">
      <img class="mySlides" src="shirt.jpg" style="width:100%">
</div>
</div>
</div>
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
         <!--Footer-->
       
        <!--Footer end-->
        
        
        
    </body>
</html>
