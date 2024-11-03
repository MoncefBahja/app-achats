<?php 
    session_start();

    header("Access-Control-Allow-Origin: *");

    include('./config.php');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

        if(isset($_SESSION['id']) && isset($_SESSION['role'])) {
        
            // Your SQL query to get the product data goes here
            $stmt = $conn->prepare("SELECT p.*, SUM(c.quantity) as quantity_count 
                                    FROM products p 
                                    JOIN cart c ON p.id = c.product_id 
                                    WHERE c.user_id = :user_id
                                    GROUP BY p.id");
            $stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } 

        $output = [];
        
        // Fetch data from the database and add to the output array
        foreach ($data as $row) {
            $product = [];
            $product['image_url'] = $row['image_url'];
            $product['name'] = $row['name'];
            $product['id'] = $row['id'];
            $product['quantity_count'] = $row['quantity_count'];
            $product['price'] = $row['price'];
            
            $output[] = $product;
        }
            
        // Send the output as JSON data
        header('Content-Type: application/json');
        echo json_encode($output);
        exit;
    }
    
    $conn = null;
    
?>