<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
$pdo = getDbInstance();

if($_SESSION['admin_type']!='super'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
}


// Delete a user using user_id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $stmt = $pdo->prepare("DELETE FROM admin_accounts WHERE id = :id");
    $stmt->bindParam(':id', $del_id);
    $stat = $stmt->execute();
    if ($stat) {
        $_SESSION['info'] = "User deleted successfully!";
        header('location: admin_users.php');
        exit;
    }
}