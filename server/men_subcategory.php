<?php
header("Access-Control-Allow-Origin: *");

include('./config.php');
include('./trie.php');

$output = [];
$result = [];

if (isset($_POST['men_subcategory'])) {

    $men_subcategory = $_POST['men_subcategory'];
    $gender = "men";

    // query database
    $stmt = $conn->prepare("
            SELECT p.*, c.name AS category, s.name AS subcategory 
            FROM products p 
            JOIN subcategories s ON p.subcategory_id = s.id 
            JOIN categories c ON s.category_id = c.id 
            WHERE s.name = :men_subcategory 
            AND c.gender = :gender
            ORDER BY p.created_at DESC
        ");
    $stmt->bindParam(':men_subcategory', $men_subcategory);
    $stmt->bindParam(':gender', $gender);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);



    foreach ($data as $row) {
        $product = [];
        $product['image_url'] = $row['image_url'];
        $product['name'] = $row['name'];
        $product['category'] = $row['category'];
        $product['subcategory'] = $row['subcategory'];
        $product['price'] = $row['price'] - (($row['price'] * 15) / 100);
        $product['discount_price'] = $row['price'];

        $result[] = $product;
    }

    // Send the output as JSON data
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;

} elseif (isset($_POST['men_category'])) {

    $men_category = $_POST['men_category'];
    $gender = "men";

    // query database
    $stmt = $conn->prepare("
            SELECT p.*, c.name AS category
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE c.name = :men_category
            AND c.gender = :gender
            ORDER BY p.created_at DESC
        ");
    $stmt->bindParam(':men_category', $men_category);
    $stmt->bindParam(':gender', $gender);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);




    foreach ($data as $row) {
        $product = [];
        $product['image_url'] = $row['image_url'];
        $product['name'] = $row['name'];
        $product['category'] = $row['category'];
        $product['price'] = $row['price'] - (($row['price'] * 15) / 100);
        $product['discount_price'] = $row['price'];

        $result[] = $product;
    }

    // Send the output as JSON data
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
