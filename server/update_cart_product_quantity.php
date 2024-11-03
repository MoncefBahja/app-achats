<?php

    header("Access-Control-Allow-Origin: *");

    include('./config.php');

    // Check if the increment form has been submitted
    if(isset($_POST['product_id_inc'])) {
        
        $product_id = $_POST['product_id_inc'];
        
        // Get the current quantity of the product
        $stmt = $pdo->prepare("SELECT quantity_count FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $current_quantity = $row['quantity_count'];
        
        // Increment the quantity by 1
        $new_quantity = $current_quantity + 1;
        
        // Update the quantity in the database
        $stmt = $pdo->prepare("UPDATE products SET quantity_count = ? WHERE id = ?");
        $stmt->execute([$new_quantity, $product_id]);
        
        // Return the new quantity to the AJAX success function
        echo $new_quantity;
        
    }
    
    // Check if the decrement form has been submitted
    if(isset($_POST['product_id'])) {
        
        $product_id = $_POST['product_id'];
        
        // Get the current quantity of the product
        $stmt = $pdo->prepare("SELECT quantity_count FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $current_quantity = $row['quantity_count'];
        
        // Decrement the quantity by 1, but don't allow it to go below 1
        $new_quantity = max($current_quantity - 1, 1);
        
        // Update the quantity in the database
        $stmt = $pdo->prepare("UPDATE products SET quantity_count = ? WHERE id = ?");
        $stmt->execute([$new_quantity, $product_id]);
        
        // Return the new quantity to the AJAX success function
        echo $new_quantity;
        
    }

?>
