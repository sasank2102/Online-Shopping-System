<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 require 'config.php';
 $sql = "INSERT INTO admin (usrname,password) VALUES ('admin1','".password_hash('admin1', PASSWORD_DEFAULT)."')"; 
 $mysqli->query($sql);