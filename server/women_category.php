<?php
    header("Access-Control-Allow-Origin: *");

    include('./config.php');
    include('./trie.php');

    $output = [];
    $result = [];

    if(isset($_POST['women_category'])){

        $women_category = $_POST['women_category'];
        $gender = "women";

        // query database
        $stmt = $conn->prepare("
            SELECT p.*, c.name AS category
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE c.name = :women_subcategory 
            AND c.gender = :gender
            ORDER BY p.created_at DESC
        ");
        $stmt->bindParam(':women_category', $women_category);
        $stmt->bindParam(':gender', $gender);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            

        foreach($data as $row) {
            $product = [];
            $product['image_url'] = $row['image_url'];
            $product['name'] = $row['name'];
            $product['category'] = $row['category'];
            $product['subcategory'] = $row['subcategory'];
            $product['price'] = $row['price'] - (($row['price'] * 15) / 100);
            $product['discount_price'] = $row['price'];
        
            $result[] = $product;
        }        

    }

    // Send the output as JSON data
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;

?>
