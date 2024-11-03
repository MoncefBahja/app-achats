<?php
    require('./config.php');

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $address_line_one = $_POST["address_line_one"];
    $address_line_two = $_POST["address_line_two"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $region = $_POST["region"];
    $postalcode = $_POST["postalcode"];
    
    
    // prepare the statement
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, phone, birthdate, gender, address_line_one, address_line_two, country, city, region, postalcode, created_at) 
                            VALUES (:fullname, :email, :password, :phone, :birthdate, :gender, :address_line_one, :address_line_two, :country, :city, :region, :postalcode, :created_at)");
    
    // bind parameters
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':birthdate', $birthdate);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':address_line_one', $address_line_one);
    $stmt->bindParam(':address_line_two', $address_line_two);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':postalcode', $postalcode);
    $created_at = date('Y-m-d H:i:s');
    $stmt->bindParam(':created_at', $created_at);
    
    // execute the statement
    $stmt->execute();
    
    echo "success";
    
    $conn = null;    
?>
