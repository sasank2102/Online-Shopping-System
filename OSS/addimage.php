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
    $img_err = "";

// Processing form data when form is submitted
    ?>
    <body>
        <?php include 'footer.php' ?>
        <?php include 'navbar1.php' ?>




        <div class="container">
            <div class="row row_style">
                <div class="col-xs-4 col-xs-offset-4" style="margin:20px;padding: 20px;">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="container">
                        <h4>Add Product Image:</h4>
                        <input class="btn btn-primary"type="file" name="fileToUpload" id="fileToUpload">
                        <br>
                        <input class="btn btn-primary"type="submit" value="Upload Image" name="submit">
                    </form>
</div>  
                </div>
            </div>
        </div>
        <!--Footer-->

        <!--Footer end-->
    </body>
</html>
