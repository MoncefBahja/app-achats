<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
$pdo = getDbInstance();
if(isset($_POST['category_id'])) {
    
    $stmt = $pdo->prepare("SELECT * FROM subcategories WHERE category_id = ?");
    $stmt->execute([$_POST['category_id']]);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $opt_arr = $res;

    foreach ($opt_arr as $opt) {
        if ($edit && $opt == $customer['category_id']) {
            $sel = "selected";
        } else {
            $sel = "";
        }
        echo '<option value="'.$opt['id'].'" ' . $sel . '>' . $opt['name'] . '</option>';
    }
}
?>