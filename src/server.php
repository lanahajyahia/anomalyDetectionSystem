<?php
//phpinfo();
session_start(); 

$servername = "db";
$username = "root";
$password = "example";
$dbname = "anomalyDetection";

// Connect to MySQL // crate dbabase if not already exist
$link = new mysqli($servername, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
// Create database
$sql = 'CREATE DATABASE '. $dbname;

if ($link->query($sql) === TRUE) {
  echo "Database created successfully";
  $connection = new mysqli($servername, $username, $password,$dbname);
  createUsersTable();
    
} else {
  echo "Error creating database: " . $link->error;
}

//mysql_close($link);

// functions for table creation
function createUsersTable() {
  global $connection;
  $sql_user =  "CREATE TABLE Users (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    user_type VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if ($connection->query($sql_user) === TRUE) {
      echo "Table MyGuests created successfully";
    } else {
      echo "Error creating table: " . $connection->error;
    }
    
}
function createXSSInjectionsTable() {
}
function createSQLiTable() {
}
?>
 
 
 
 
 
 
 <!-- <?php
session_start(); 

$servername = "db";
$username = "root";
$password = "example";
$dbname = "anomalyDetection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_SESSION["alert"])){
$alert= $_SESSION["alert"];
$type = $_SESSION["injection_type"];
$desc = $_SESSION["injection_description"];
$date = $_SESSION["injection_date"];
$time = $_SESSION["injection_time"];
$url =$_SESSION["injection_url"];
$sql = "INSERT INTO xss_detections (type, date,time,response_header, description)
VALUES ('$type','$date','$time','$url', '$desc')";

if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
  unset( $_SESSION["alert"]);
  unset($_SESSION["injection_url"]);
  unset($_SESSION["injection_time"]);
  unset($_SESSION["injection_date"]);
  unset($_SESSION["injection_description"]);
  unset($_SESSION["injection_type"]);

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}}

//$conn->close();
?>  -->