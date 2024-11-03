<?php

    session_start();
    header("Access-Control-Allow-Origin: *");
    include('./config.php');

    $user_id = $_SESSION['id'];

    // Call the stored procedure to calculate the total quantity of products in cart
    $stmt = $conn->prepare("CALL calculate_total_quantity(:user_id, @total_quantity)");
    $stmt->bindValue(":user_id", $user_id);
    $stmt->execute();
    $stmt->closeCursor();

    // Retrieve the output variable
    $output_stmt = $conn->query("SELECT @total_quantity AS `total_quantity`");
    $output = $output_stmt->fetch(PDO::FETCH_ASSOC);
    $output_stmt->closeCursor();

    $total_quantity = $output['total_quantity'];

    if($total_quantity == 0) {
        $total_quantity = 0;
    }

    $output = [
        'total_quantity' => $total_quantity
    ];

    // Send the output as JSON data
    header('Content-Type: application/json');
    echo json_encode($output);
    exit;

    $conn = null;

?>
