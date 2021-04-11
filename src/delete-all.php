<?php
//include database configuration file
include 'server.php';

//get records from database
//$query = $connection->query("SELECT * FROM Users ORDER BY id DESC");
// sql to delete a record
$sql = "DELETE FROM Users";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

exit;

?>