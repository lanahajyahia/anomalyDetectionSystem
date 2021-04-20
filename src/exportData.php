<?php
//include database configuration file
// include 'server.php';

function exportAttack($table_name, $type)
{
  global $connection;

  //get records from database
  $query = $connection->query("SELECT * FROM $table_name ORDER BY id DESC");

  if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = $table_name . "_reports_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('ID', 'Date', 'Time', 'HTTP URL', 'method', 'description');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch_assoc()) {
      //  $status = ($row['status'] == '1')?'Active':'Inactive';
      $lineData = array($row['id'], $row['date'], $row['time'], $row['http_url'], $row['http_method'], $row['description']);
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
  // exit();
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
    $fields = array('ID', 'Username', 'Email', 'User type', 'User Creation');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch_assoc()) {
      //  $status = ($row['status'] == '1')?'Active':'Inactive';
      $lineData = array($row['id'], $row['username'], $row['email'], $row['user_type'], $row['reg_date']);
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
