<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Only super admin is allowed to access this page
if ($_SESSION['admin_type'] !== 'super') {
    // show permission denied message
    echo 'Permission Denied';
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $pdo = getDbInstance();
    
    //Check whether the user name already exists ; 
    $stmt = $pdo->prepare('SELECT * FROM admin_accounts WHERE user_name = :user_name');
    $stmt->execute(['user_name' => $data_to_store['user_name']]);
    $count = $stmt->rowCount();
    
    if ($count >= 1){
        $_SESSION['failure'] = "User name already exists";
        header('location: add_admin.php');
        exit();
    }

    //Encrypt password
    $data_to_store['password'] = password_hash($data_to_store['password'],PASSWORD_DEFAULT);
    
    //reset pdo instance
    $pdo = getDbInstance();
    $stmt = $pdo->prepare('INSERT INTO admin_accounts (user_name, password, admin_type) VALUES (:user_name, :password, :admin_type)');
    $result = $stmt->execute([
        'user_name' => $data_to_store['user_name'],
        'password' => $data_to_store['password'],
        'admin_type' => $data_to_store['admin_type']
    ]);
    
    if($result)
    {
        $_SESSION['success'] = "Admin user added successfully!";
        header('location: admin_users.php');
        exit();
    }  
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Add User</h2>
        </div>
    </div>
     <?php 
    include_once('includes/flash_messages.php');
    ?>
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/admin_users_form.php'; ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
