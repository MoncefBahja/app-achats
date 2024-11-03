<?php   

    session_start();
    header("Access-Control-Allow-Origin: *");
    include('./config.php');

    if(isset($_SESSION['id'])) {
    
        $user_id = $_SESSION['id'];

        // Call the stored procedure to calculate the total amount
        $stmt = $conn->prepare("CALL calculate_total_amount(:user_id, @subtotal, @tax, @total_amount)");
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        $stmt->closeCursor();

        // Retrieve the output variables
        $output_stmt = $conn->query("SELECT @subtotal AS `subtotal`, @tax AS `tax`, @total_amount AS `total_amount`");
        $output = $output_stmt->fetch(PDO::FETCH_ASSOC);
        $output_stmt->closeCursor();

    
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (:user_id, :total)");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":total", $output['total_amount']);
    
        $stmt->execute();

        echo "success";
    }

    $conn = null;
    
?>
