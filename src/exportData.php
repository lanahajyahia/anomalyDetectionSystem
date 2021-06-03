<?php

function exportAttack($table_name, $type = null)
{
  global $connection;

  //get records from database
  if ($type == null) {
    $sql = "SELECT * FROM $table_name ORDER BY id DESC";
    $query = $connection->query($sql);
  } else {
    $sql = "SELECT * FROM $table_name WHERE type='$type' ORDER BY id DESC";
    $query = $connection->query($sql);
  }
  if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = $table_name . "_reports_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('ID', 'Type', 'Date', 'Time', 'HTTP URL', 'path', 'method', 'description');
    fputcsv($f, $fields, $delimiter);
    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch_assoc()) {
      $lineData = array($row['id'], $row['type'], $row['date'], $row['time'], $row['hostname'], $row['path'], $row['http_method'], $row['description']);
      fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);
    ob_end_clean();
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
  }
  exit();
}
function exportUsers()
{
  global $connection;

  //get records from database
  $query = $connection->query("SELECT * FROM Users ORDER BY id DESC");

  if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "users_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('ID', 'Full Name', 'Username', 'Email', 'User type', 'User Creation', 'Last Login');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch_assoc()) {
      $lineData = array($row['id'], $row['fullname'], $row['username'], $row['email'], $row['user_type'], $row['reg_date'], $row['last_activity']);
      fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
  }
  exit();
}
