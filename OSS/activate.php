<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config.php';
session_start();
if (isset($_GET["id"])) {
  $id = intval(base64_decode($_GET["id"]));
 
  $sql = "SELECT status from users where id =".$id;
  
    $result = $mysqli->query($sql);
                    $row = $result->fetch_assoc();
 
  
 
      if ($row['status'] == 1) {
        $_SESSION['login_err'] = "Your account has already been activated.";
        
        $msgType = "info";
      } else {
        $sql = "UPDATE users SET  status=1 WHERE id=".$id;
        
       if($mysqli->query($sql)){
           echo 'success';
           
       }else{
           echo 'error';
       }
       
       //echo $sql;
        
        $_SESSION['login_err'] = "Your account has been activated.";
        $msgType = "success";
        
      }
    header("location:login.php");
 
}

//header("location:login.php");