<?php

    session_start();
    header("Access-Control-Allow-Origin: *");
    include('./config.php');

    if(isset($_SESSION['id'])) {
        if (isset($_POST['product_id'])) {
            $id = $_POST['product_id'];
    
            $user_id = $_SESSION['id'];
    
            $stmt = $conn->prepare("SELECT * FROM cart WHERE product_id = :id AND user_id = :user_id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->rowCount();
            if($result > 0) {
                $stmt = $conn->prepare("SELECT c.quantity FROM products p INNER JOIN cart c ON p.id = c.product_id WHERE c.user_id = :user_id");
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
    
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
                $quantity = $result['quantity'];
                $quantity += 1;
    
                $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :id AND user_id = :user_id");
                $stmt->bindParam(":quantity", $quantity);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(":id", $id);
    
                $stmt->execute();
            } else {
                $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
    
                $stmt->bindParam(":user_id", $user_id);
                $stmt->bindParam(":product_id", $product_id);
                $stmt->bindParam(":quantity", $quantity);
    
                $product_id = $id;
                $quantity = 1;
    
                $stmt->execute();
            }
    
            echo "success";
        } else {
            echo "failed";
        }
    } 

    $conn = null;
    
?>
