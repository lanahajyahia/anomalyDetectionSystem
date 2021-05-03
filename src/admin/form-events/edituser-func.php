<?php
session_start();
require("../../server.php");

 $errors =array();
$id = (int)$_SESSION['id-to-edit'];
$username = e($_POST['username-update']);
//  echo $username;
// echo '<script>alert("Welcome to Geeks for Geeks")</script>';
if (!empty($username)) {
	if (is_numeric($username[0])) {
		array_push($errors, "Username must start with a letter!");
		// echo $errors;
		// echo '<script>alert("Welcome to Geeks for Geeks")</script>';
		// $_POST['username-update'] = null;
		 header("Location: ../../admin/users.php?edit-id=$id");
	} else {
		$query = "UPDATE Users SET username='$username' WHERE id=$id";
		if ($connection->query($query) === TRUE) {
		header("Location: ../../admin/users.php");}
	}
}



// escape string specail chars if any 
function e($val)
{
	global $connection;
	return mysqli_real_escape_string($connection, trim($val));
}

function display_error()
{
	global $errors;

	if (count($errors) > 0) {
		echo '<div class="error">';
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		echo '</div>';
	}
}
