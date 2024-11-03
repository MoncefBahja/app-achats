<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);
    $hashedPassword = password_hash($data_to_store['password'], PASSWORD_DEFAULT);
    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $pdo = getDbInstance();
    
    $sql = "INSERT INTO users (fullname, email, password, phone, birthdate, gender, address_line_one, address_line_two, country, city, region, postalcode, role, created_at) 
        VALUES (:fullname, :email, :password, :phone, :birthdate, :gender, :address_line_one, :address_line_two, :country, :city, :region, :postalcode, 0, :created_at)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fullname', $data_to_store['fullname']);
    $stmt->bindParam(':email', $data_to_store['email']);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':phone', $data_to_store['phone']);
    $stmt->bindParam(':birthdate', $data_to_store['birthdate']);
    $stmt->bindParam(':gender', $data_to_store['gender']);
    $stmt->bindParam(':address_line_one', $data_to_store['address_line_one']);
    $stmt->bindParam(':address_line_two', $data_to_store['address_line_two']);
    $stmt->bindParam(':country', $data_to_store['country']);
    $stmt->bindParam(':city', $data_to_store['city']);
    $stmt->bindParam(':region', $data_to_store['region']);
    $stmt->bindParam(':postalcode', $data_to_store['postalcode']);
    $stmt->bindParam(':created_at', $data_to_store['created_at']);
    
    $result = $stmt->execute();
    
    if($result)
    {
        $_SESSION['success'] = "Customer added successfully!";
        header('location: customers.php');
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
                <h2 class="page-header">Add Customers</h2>
            </div>
            
    </div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">
       <?php  include_once('./forms/customer_form.php'); ?>
    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#customer_form").validate({
       rules: {
            fullname: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>
