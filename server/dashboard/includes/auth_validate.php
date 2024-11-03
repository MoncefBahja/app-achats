<?php

//If User is logged in the session['id'] will be set to true

//if user is Not Logged in, redirect to login.php page.
 if (!isset($_SESSION['admin_id'])) {
 	header('Location:../../src/components/auth/login.html');
 }
 
 ?>