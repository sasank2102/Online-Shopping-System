
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title> Admin Login Page</title>
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
$usrname = $password = "";
$usrname_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["usrname"]))){
        $usrname_err = 'Please enter username.';
    } else{
        $usrname = trim($_POST["usrname"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($usrname_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT usrname, password FROM admin WHERE usrname = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $usrname);
            
            // Set parameters
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($usrname, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['loggedin']=TRUE;
                            $_SESSION['adminloggedin'] = TRUE;
                            $_SESSION['admin']=TRUE;
                            header("location: adminpage.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
    <body>
        <?php include 'footer.php' ?>
        <?php include 'navbar1.php'?>
        
        
        
        
        <div class="container" style="margin-top:20px;">
            <div class="row row_style">
                 <div class="col-xs-4 col-xs-offset-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>ADMIN LOGIN</h3>
                        </div>
                        <div class="panel-body">
                            
                            <!--<button class="btn btn-primary">Demo</button>-->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <input type="text"  class="form-control" name="usrname"  placeholder="Username" value="<?php echo $usrname; ?>" >
                            <span class="help-block  alert-danger"><?php echo $usrname_err; ?></span>
                        </div>
                                
                        <div class="form-group">
                            <input type="password"  class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>">
                            <span class="help-block  alert-danger"><?php echo $password_err; ?></span>
                        </div>
                                <button type="submit" class="btn btn-primary">Login</button><br><br>
                    </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
          <!--Footer-->
        
        <!--Footer end-->
    </body>
</html>
