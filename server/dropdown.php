<?php
    header("Access-Control-Allow-Origin: *");

    include('./config.php');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        // Your SQL query to get the product data goes here
        $stmt = $conn->prepare("SELECT * FROM categories WHERE gender = 'men'");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $men = [];
        foreach($data as $row) {
            $m = [];
            $m['name'] = $row['name'];
            $m['id'] = $row['id'];


            $men[] = $m;
        }

        $stmt = $conn->prepare("SELECT * FROM categories WHERE gender = 'women'");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $women = [];
        foreach($data as $row) {
            $w = [];
            $w['name'] = $row['name'];
            $w['id'] = $row['id'];


            $women[] = $w;
        }


        $output = [
            'men' => $men,
            'women' => $women
        ];

        // Send the output as JSON data
        header('Content-Type: application/json');
        echo json_encode($output);
        exit;
    }
?>
