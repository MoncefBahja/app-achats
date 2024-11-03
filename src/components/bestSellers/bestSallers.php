<?php
require ('../../../server/config.php');

$sql = "SELECT * FROM products WHERE price <= 100" ;
$stmt = $conn->prepare($sql) ;
$stmt->execute() ;
$data = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

$output = [];
    
// Fetch data from the database and add to the output array
foreach ($data as $row) {
    $product = [];
    $product['image_url'] = $row['image_url'];
    $product['name'] = $row['name'];
    $product['id'] = $row['id'];
    $product['description'] = $row['description'];
    $product['price'] = $row['price'] - (($row['price'] * 15) / 100);
    $product['discount_price'] = $row['price'];

    $output[] = $product;
}

// Send the output as JSON data
header('Content-Type: application/json');
echo json_encode($output);
exit;


$conn = null;



?>