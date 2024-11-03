<?php
include '../../../server/config.php' ;
    $first=$_POST['first'];
    $last=$_POST['last'];
    $email=$_POST['email'];
    $message=$_POST['message'];

  


    $sql = "INSERT INTO contact (first, last, email, message) VALUES (:first, :last, :email, :message)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':first', $first);
$stmt->bindParam(':last', $last);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':message', $message);

$stmt->execute();
echo "successfully";
    
     $conn = null;  


?>