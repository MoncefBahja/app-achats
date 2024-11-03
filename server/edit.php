<?php 
   session_start();

   include("backend/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.html");
   }

   if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $age = $_POST['age'];

        $id = $_SESSION['id'];

        $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id ") or die("error occurred");

        if($edit_query){
            header("Location: home.html");
            exit();
        }
   }else{
        $id = $_SESSION['id'];
        $query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id ");

        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
        }

        include("edit.html");
    }
?>
