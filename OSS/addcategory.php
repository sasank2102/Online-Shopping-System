

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
require_once 'config.php';
         function doesnotcontainalpha($s){
            $c=0;
            for($i=0;$i<strlen($s);$i++){
                if(ctype_alpha($s[$i])){
                    $c++;
                    break;
            }}
                if($c)  {
                    return FALSE;
            } else {
            return TRUE;    
            }
        }
// Define variables and initialize with empty values
$pname = $price = $category = $sub_cat = $quantity= $img="";
$pname_err = $price_err = $category_err = $sub_cat_err = $quantity_err= $img_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){
 
    // Validate username
   
    
       
    

   
    
     if(isset($_GET['category']))
    if(empty(trim($_GET["category"]))){
        $category_err = "Please enter Category.";
    } else if(preg_match ('/[^a-z_\'\s\-0-9]/i', trim ($_GET["category"]))||doesnotcontainalpha($_GET["category"]))
    {    
        $category_err= "Category name should consists of only alphabets,numbers";
    }else{
        $category=trim($_GET['category']);
    }  
    
     if(isset($_GET['sub_cat']))
    if(empty(trim($_GET["sub_cat"]))){
        $sub_cat_err = "Please enter Sub-Category.";
    } else if(preg_match ('/[^a-z_\'\s\-0-9]/i', trim ($_GET["sub_cat"]))||doesnotcontainalpha($_GET["sub_cat"]))
    {    
        $sub_cat_err= "SubCategory name should consists of only alphabets,numbers";
    }else {
        $sub_cat=trim($_GET['sub_cat']);
    } 
    
  
    
    // Check input errors before inserting in database
    if(isset($_GET['category'])&&isset($_GET['sub_cat']))
    if( empty($category_err) && empty($sub_cat_err) ){
        
        // Prepare an insert statement
        
          $sql=" select cid from category where cname='".addslashes($_GET['category'])."'";
       $result=$mysqli->query($sql);
        if($result->num_rows==0)
        {
       $sql="insert into category(cname) values ('".addslashes($_GET['category'])."')";
       $mysqli->query($sql);
        }
       $sql=" select cid from category where cname='".addslashes($_GET['category'])."'";
       $result=$mysqli->query($sql);
       $row=$result->fetch_assoc();
       $sql="insert into sub_category(cid,scname) values (".$row['cid'].",'". addslashes($_GET['sub_cat'])."')";
       $mysqli->query($sql);
         
       header("location:adminpage.php");
         
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
                    <h1> Add New Category </h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                        <div class="form-group">
                            <input type="text"  class="form-control" name="category"  placeholder="New Category" value="<?php echo $category; ?>" >
                            <span class="help-block alert-danger"><?php echo $category_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="sub_cat" placeholder="New Subcategory" value="<?php echo $sub_cat; ?>">
                            <span class="help-block alert-danger"><?php echo $sub_cat_err; ?></span>
                        </div>
            
            <button type="submit" class="btn btn-primary">Add Category</button>
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
