<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: subcategories.php');
        exit;

	}
    $subcategory_id = $del_id;

    $pdo = getDbInstance();
    $stmt = $pdo->prepare("DELETE FROM subcategories WHERE id=:id");
    $stmt->bindParam(':id', $subcategory_id);
    $status = $stmt->execute();

    
    if ($status) 
    {
        $_SESSION['info'] = "Subcategory deleted successfully!";
        header('location: subcategories.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete subcategory";
    	header('location: subcategories.php');
        exit;

    }
    
}