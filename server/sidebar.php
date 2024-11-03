<?php
    header("Access-Control-Allow-Origin: *");

    include('./config.php');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        // Your SQL query to get the product data goes here
        $stmt = $conn->prepare("SELECT * FROM categories WHERE gender = 'men'");
        $stmt->execute();
        $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $output1 = [];

        // Fetch data from the database and add to the output array
        foreach ($data1 as $row) {
            $category = [];
            $category['name'] = $row['name'];
            $category['id'] = $row['id'];


            // Get subcategories for this category
            $stmt2 = $conn->prepare("SELECT * FROM subcategories WHERE category_id = :category_id");
            $stmt2->bindParam(':category_id', $row['id']);
            $stmt2->execute();
            $data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $subcategories = [];

            // Fetch data from the database and add to the subcategories array
            foreach ($data2 as $row2) {
                $subcategory = [];
                $subcategory['name'] = $row2['name'];
                $subcategory['id'] = $row2['id'];


                $subcategories[] = $subcategory;
            }

            // Add the subcategories array to the category array
            $category['subcategories'] = $subcategories;

            $output1[] = $category;
        }

        $output = [
            'categories' => $output1
        ];

        // Send the output as JSON data
        header('Content-Type: application/json');
        echo json_encode($output);
        exit;
    }
?>
