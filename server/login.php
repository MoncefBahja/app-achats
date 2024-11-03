<?php
session_start();
require('./config.php');

if (isset($_POST['login']) && isset($_POST['password'])) {

    if (strpos($_POST["login"], '@') !== false) {
        $login = filter_input(INPUT_POST, 'login', FILTER_VALIDATE_EMAIL);
        $password = $_POST["password"];
        if ($login === false) {
            echo "Invalid email address";
            exit();
        }
    } else {
        $login = $_POST["login"];
        $password = $_POST["password"];
    }
    
    // $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
    // $stmt->execute(array($login, $password));
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->bindParam(':email', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $stmt = $conn->prepare("SELECT * FROM `admin_accounts` WHERE `user_name` = ?");
        $stmt->execute(array($login));
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // to be deleted
        setcookie('id', $user['id'], time() + 86400 * 30, '/');
        echo "user";
    } else if ($admin !== false && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        if($admin['admin_type'] == 'super') {
            $_SESSION['admin_type'] = $admin['admin_type'];
        } else {
            $_SESSION['admin_type'] = $admin['admin_type'];
        }
        if(isset($_COOKIE['id'])) setcookie('id', '', time() - 86400 * 30, '/');
        setcookie('admin_id', $admin['id'], time() + 86400 * 30, '/');
        echo "admin";
    } else {
        echo "Invalid email or password";
    }
}

$conn = null;
