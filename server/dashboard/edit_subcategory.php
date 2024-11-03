<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

// Sanitize if you want
$subcategory_id = filter_input(INPUT_GET, 'subcategory_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

($operation == 'edit') ? $edit = true : $edit = false;
$pdo = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $subcategory_id = filter_input(INPUT_GET, 'subcategory_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $stmt = $pdo->prepare("UPDATE subcategories SET name=:name, category_id=:category_id WHERE id=:id");
    $stmt->bindParam(':name', $data_to_update['name']);
    $stmt->bindParam(':category_id', $data_to_update['category_id']);
    $stmt->bindParam(':id', $category_id);
    
    if($stmt->execute())
    {
        $_SESSION['success'] = "Subcategory updated successfully!";
        //Redirect to the listing page,
        header('location: subcategories.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}

//If edit variable is set, we are performing the update operation.
if($edit)
{
    $stmt = $pdo->prepare("SELECT * FROM subcategories WHERE id=:id");
    $stmt->bindParam(':id', $subcategory_id);
    $stmt->execute();
    //Get data to pre-populate the form.
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include_once 'includes/header.php'; ?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Subcategory</h2>
    </div>
    <!-- Flash messages -->
    <?php include('./includes/flash_messages.php') ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/subcategory_form.php'); 
        ?>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>
