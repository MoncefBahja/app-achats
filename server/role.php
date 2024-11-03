<?php 
    session_start();
    require('./config.php');
    
    if((isset($_SESSION['id']) && isset($_SESSION['role']))) {
      if($_SESSION['role'] == 0 || $_COOKIE['role'] == 0) {
        echo "user";
      } else if($_SESSION['role'] == 1) {
        echo "admin";
      }
    } else {
      echo "not_logged_in";
    }
    
    $conn = null;    
?>