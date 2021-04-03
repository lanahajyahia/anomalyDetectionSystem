
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



<!-- <!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			
			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<?php header("location: dashboard.php"); ?>

					<!-- <small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small> -->

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html> -->