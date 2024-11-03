<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include("./config.php");

if(isset($_POST['inc'])) {
    $product_id = $_POST['inc'];
    $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE product_id = :product_id AND user_id = :user_id");
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":user_id", $_SESSION['id']);
    $result = $stmt->execute();
    if($result) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}

?>