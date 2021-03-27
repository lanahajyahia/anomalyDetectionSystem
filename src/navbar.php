<!DOCTYPE html>
<html lang="en">
<head>
  <title>nav bar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
</head>
<body>

<nav class="navbar" style="border-radius: 0px !important; margin-bottom: 0px !important; background:#333 !important;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="dashboard.php">Anomaly Detection</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="dashboard.php">Dashboard</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Logs <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Logs/sqliLogs.php">SQLi</a></li>
          <li><a href="reflectedLogs.php">Reflected xss</a></li>
          <li><a href="Logs/storedLogs.php">Stored xss</a></li>
          <li><a href="Logs/domLogs.php">Dom xss</a></li>
        </ul>
      </li>
      <li><a href="user.php">Users</a></li>
      <li><a href="monitor.php">Website Monitor</a></li>
    </ul>
    <!--  if login show name + logout -->
    <ul class="nav navbar-nav navbar-right">
      <li><a href="..\multi_login\register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="..\multi_login\login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>


</body>
</html> 