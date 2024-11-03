<?php 

    header("Access-Control-Allow-Origin: *");

    include('./config.php');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

        // Your SQL query to get the product data goes here
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 1");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $output = [];
    
        // Fetch data from the database and add to the output array
        foreach ($data as $row) {
            $product = [];
            $product['image_url'] = $row['image_url'];
            $product['name'] = $row['name'];
            $product['id'] = $row['id'];
            $product['description'] = $row['description'];
            $product['price'] = $row['price'] - (($row['price'] * 40) / 100);
            $product['discount_price'] = $row['price'];
    
            $output[] = $product;
        }
    
        // Send the output as JSON data
        header('Content-Type: application/json');
        echo json_encode($output);
        exit;
    }
    
    $conn = null;
    
?>