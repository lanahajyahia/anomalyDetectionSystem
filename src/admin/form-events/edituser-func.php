<?php
// session_start();
// global $connection;
require("../../server.php");
// echo "fds";
// global $connection, $errors, $username;
$id = (int)$_SESSION['id-to-edit'];
// echo var_dump($id);
// echo $id;
// var_dump($_POST);
// die();
$username = $_POST['username-update'];
// echo $username;

$query = "UPDATE Users SET username='$username' WHERE id=$id";
if ($connection->query($query) === TRUE) {
	header("Location: ../../admin/users.php");
	// exit;
	// echo "Record updated successfully";
} else {
	// echo "Error updating record: " . $connection->error;
}
	// if ($password != null) {
	//     $password = hash('sha256', $_POST['password']);
	//     $query = $mysqli->query("UPDATE `$table` SET username='$username', password='$password' WHERE id='$id'");
	// }
	// echo '<meta http-equiv="refresh" content="0;url=users.php">';
