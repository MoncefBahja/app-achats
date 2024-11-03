<?php
header("Access-Control-Allow-Origin: *");

include('./config.php');
include('./trie.php');

$result = [];

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :search");

    // Bind the search parameter
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch all matching products
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results
    foreach ($products as $row) {
        $productData = [];
        $productData['image_url'] = $row['image_url'];
        $productData['name'] = $row['name'];
        $stmt = $conn->prepare("SELECT name FROM categories WHERE id = :category_id");
        $stmt->bindParam(':category_id', $row['category_id']);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        $productData['category'] = $category['name'];
        $productData['price'] = $row['price'] - (($row['price'] * 15) / 100);
        $productData['discount_price'] = $row['price'];

        $result[] = $productData;
    }
}

// Send the output as JSON data
header('Content-Type: application/json');
echo json_encode($result);
exit;
?>
