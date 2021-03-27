<?php
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
?>