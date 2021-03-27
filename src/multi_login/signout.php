<?php 
// log user out if logout button clicked
    session_start();
	session_destroy();
	unset($_SESSION['user']);
    unset($_SESSION['success']);
	header("location: ../dashboard.php");


?>