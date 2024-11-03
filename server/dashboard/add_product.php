<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);
    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $pdo = getDbInstance();

    // Insert product data into the products table
    $sql = "INSERT INTO products (name, description, stock, price, category_id, subcategory_id, image_url, created_at) 
    VALUES (:name, :description, :stock, :price, :category_id, :subcategory_id, :image_url, :created_at)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $data_to_store['name']);
    $stmt->bindParam(':description', $data_to_store['description']);
    $stmt->bindParam(':stock', $data_to_store['stock']);
    $stmt->bindParam(':price', $data_to_store['price']);
    $stmt->bindParam(':category_id', $data_to_store['category_id']);
    $stmt->bindParam(':subcategory_id', $data_to_store['subcategory_id']);
    $stmt->bindParam(':image_url', $_FILES['image_url']['name']);
    $stmt->bindParam(':created_at', $data_to_store['created_at']);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success'] = "Product added successfully!";
        header('location: products.php');
        exit();
    } else {
        echo 'Insert failed: ' . $pdo->errorInfo()[2];
        exit();
    }
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Add Product</h2>
        </div>

    </div>
    <form class="form" action="" method="post" id="product_form" enctype="multipart/form-data">
        <?php include_once('./forms/products_form.php'); ?>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#product_form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                description: {
                    required: true,
                    minlength: 3
                },
                price: {
                    required: true,
                    minlength: 1
                },
                stock: {
                    required: true,
                    minlength: 1
                },
            }
        });
    });
</script>

<?php include_once 'includes/footer.php'; ?>