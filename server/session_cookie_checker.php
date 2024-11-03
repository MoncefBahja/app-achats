<?php
header('Content-Type: application/json');
session_start();
include_once('./config.php');

$response = "";

if (isset($_COOKIE['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
    $response = "user";
} else if (isset($_COOKIE['admin_id'])) {
    $_SESSION['admin_id'] = $_COOKIE['admin_id'];
    $response = "admin";
}

echo json_encode($response);
?>
