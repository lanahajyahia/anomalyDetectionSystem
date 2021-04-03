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
  //echo "Database created successfully";
  $connection = new mysqli($servername, $username, $password,$dbname);
  createUsersTable();
  createSQLiTable();
  createXSSInjectionsTable();
    
} else {
 // echo "Error creating database: " . $link->error;
  // if database exist connect to it
  $connection = new mysqli($servername, $username, $password,$dbname);
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
     // echo "Table USERS created successfully";
    } else {
      //echo "Error creating table: " . $connection->error;
    }
    
}
function createXSSInjectionsTable() {
  global $connection;
  $sql_xss =  "CREATE TABLE XSS_injections (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(30) NOT NULL,
    time VARCHAR(50) NOT NULL,
    http_url VARCHAR(500) NOT NULL,
    http_method VARCHAR(50) NOT NULL, -- get or post
    description VARCHAR(250) NOT NULL, -- description of injection
    type VARCHAR(50) NOT NULL -- reflected / dom / stored / sqli
    )";
    if ($connection->query($sql_xss) === TRUE) {
   //   echo "Table XSS  created successfully";
    } else {
     // echo "Error creating table: " . $connection->error;
    }
    
}
function createSQLiTable() {
  global $connection;
  $sql_sqli =  "CREATE TABLE SQL_injections (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(30) NOT NULL,
    time VARCHAR(50) NOT NULL,
    http_url VARCHAR(500) NOT NULL,
    http_method VARCHAR(50) NOT NULL, -- get or post
    description VARCHAR(250) NOT NULL, -- description of injection
    type VARCHAR(50) NOT NULL -- reflected / dom / stored / sqli
    )";
    if ($connection->query($sql_sqli) === TRUE) {
     // echo "Table SQL created successfully";
    } else {
     // echo "Error creating table: " . $connection->error;
    }
}
 
 
 
 
 