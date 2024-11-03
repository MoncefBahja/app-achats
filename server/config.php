<?php 
    header('Access-Control-Allow-Origin: *');

    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "user_data";
    
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
?>