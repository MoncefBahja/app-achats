<?php

session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$db = getDbInstance();
$select = array('id', 'name', 'description', 'price', 'stock', 'category_id', 'category_name', 'subcategory_id', 'subcategory_name', 'image_url', 'created_at');

$chunk_size = 100;
$offset = 0;

$stmt = $db->query('SELECT COUNT(*) FROM users');
$total_count = $stmt->fetchColumn();

$handle = fopen('php://memory', 'w');

fputcsv($handle, $select);
$filename = 'export_products.csv';

$num_queries = ($total_count / $chunk_size) + 1;

// Prevent memory leak for large number of rows by using limit and offset:
for ($i = 0; $i < $num_queries; $i++) {
    $stmt = $db->prepare('SELECT p.id, p.name, p.description, p.price, p.stock, p.category_id, c.name as category_name, p.subcategory_id, s.name as subcategory_name, p.image_url, p.created_at 
                            FROM products p
                            JOIN categories c ON p.category_id = c.id
                            JOIN subcategories s ON p.subcategory_id = s.id
                            LIMIT :offset, :limit');

    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $chunk_size, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $offset += $chunk_size;
    foreach ($rows as $row) {
        fputcsv($handle, array_values($row));
    }
}

// Reset the file pointer to the start of the file
fseek($handle, 0);
// Tell the browser it's going to be a csv file
header('Content-Type: application/csv');
// Save instead of displaying csv string
header('Content-Disposition: attachment; filename="' . $filename . '";');
// Send the generated csv lines directly to browser
fpassthru($handle);
