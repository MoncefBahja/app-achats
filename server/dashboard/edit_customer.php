<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

// Sanitize if you want
$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

($operation == 'edit') ? $edit = true : $edit = false;
$pdo = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $stmt = $pdo->prepare("UPDATE users SET fullname=:fullname, email=:email, phone=:phone, birthdate=:birthdate, gender=:gender, address_line_one=:address_line_one, address_line_two=:address_line_two, country=:country, city=:city, region=:region, postalcode=:postalcode WHERE id=:id");
    $stmt->bindParam(':fullname', $data_to_update['fullname']);
    $stmt->bindParam(':email', $data_to_update['email']);
    $stmt->bindParam(':phone', $data_to_update['phone']);
    $stmt->bindParam(':birthdate', $data_to_update['birthdate']);
    $stmt->bindParam(':gender', $data_to_update['gender']);
    $stmt->bindParam(':address_line_one', $data_to_update['address_line_one']);
    $stmt->bindParam(':address_line_two', $data_to_update['address_line_two']);
    $stmt->bindParam(':country', $data_to_update['country']);
    $stmt->bindParam(':city', $data_to_update['city']);
    $stmt->bindParam(':region', $data_to_update['region']);
    $stmt->bindParam(':postalcode', $data_to_update['postalcode']);
    $stmt->bindParam(':id', $customer_id);
    
    if($stmt->execute())
    {
        $_SESSION['success'] = "Customer updated successfully!";
        //Redirect to the listing page,
        header('location: customers.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}

//If edit variable is set, we are performing the update operation.
if($edit)
{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->bindParam(':id', $customer_id);
    $stmt->execute();
    //Get data to pre-populate the form.
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include_once 'includes/header.php'; ?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Customer</h2>
    </div>
    <!-- Flash messages -->
    <?php include('./includes/flash_messages.php') ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/customer_form.php'); 
        ?>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>
