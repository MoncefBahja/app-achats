<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);

    $pdo = getDbInstance();
    
    
    $sql = "INSERT INTO categories (name, gender) 
        VALUES (:name, :gender)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $data_to_store['name']);
    $stmt->bindParam(':gender', $data_to_store['gender']);

    
    $result = $stmt->execute();
    
    if($result)
    {
        $_SESSION['success'] = "Category added successfully!";
        header('location: categories.php');
        exit();
    }
    else
    {
        echo 'insert failed: ' . $pdo->errorInfo()[2];
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
                <h2 class="page-header">Add Category</h2>
            </div>
            
    </div>
    <form class="form" action="" method="post"  id="category_form" enctype="multipart/form-data">
       <?php  include_once('./forms/category_form.php'); ?>
    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#category_form").validate({
       rules: {
            name: {
                required: true,
                minlength: 3
            }
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>
