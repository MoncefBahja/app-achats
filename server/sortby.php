<?php
header("Access-Control-Allow-Origin: *");

include('./config.php');

$output = [];
$result = [];

$stmt = $conn->prepare("SELECT id FROM categories WHERE name = :name");
$stmt->bindParam(':name', $_GET['men_category']);
$stmt->execute();

$id = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM products WHERE category_id = :category_id";
if (isset($_POST['sort_by'])) {
    switch ($_POST['sort_by']) {
        case 'price-low-to-high':
            $sql .= " ORDER BY price ASC";
            break;
        case 'price-high-to-low':
            $sql .= " ORDER BY price DESC";
            break;
        case 'name-a-to-z':
            $sql .= " ORDER BY name ASC";
            break;
        case 'name-z-to-a':
            $sql .= " ORDER BY name DESC";
            break;
        default:
            break;
    }
}

$stmt = $conn->prepare($sql);
$stmt->bindParam(':category_id', $id['id']);
$stmt->execute();
$data = $stmt->fetchAll();

foreach ($data as $row) {
    $product = [];
    $product['image_url'] = $row['image_url'];
    $product['name'] = $row['name'];
    $stmt = $conn->prepare("SELECT name FROM categories WHERE id = :category_id");
    $stmt->bindParam(':category_id', $row['category_id']);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    $product['category'] = $category['name'];
    $product['price'] = $row['price'] - (($row['price'] * 15) / 100);
    $product['discount_price'] = $row['price'];

    $result[] = $product;
}

header('Content-Type: application/json');
echo json_encode($result);
exit;
