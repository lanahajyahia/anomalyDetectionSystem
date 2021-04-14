<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: transparent;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content1 {
  display: none;
  position: fixed;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content1 a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}
.navbar-title{
  font-size:1.235em;
}
.navbar-title:hover{
 color:white !important;
}
.navbar{
  padding: 0px !important;
  background: #333 !important;
}
.dropdown-content1 a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content1 {
  display: block;
}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header" style="padding-left: 0.5em !important">
      <a class="navbar-brand" href="../dashboard.php">Anomaly Detection</a>
    </div>
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a href="../Logs/sqliLogs.php">SQLi</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Cross site scripting</a>
    <div class="dropdown-content1">
      <a href="../Logs/reflectedLogs.php">Reflected</a>
      <a href="../Logs/storedLogs.php">Stored</a>
    </div>
  </li>
</ul> 
<?php  if (!isset($_SESSION['success'])) : ?>
<ul class=" navbar-right">
      <li><a href="../multi_login/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="../multi_login/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>   
    <?php else : ?>
      <ul class=" navbar-right">
      <li><a href="../multi_login/account.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['firstname']; ?> </a></li>
      <li><a href="../multi_login/signout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul> 
<?php endif; ?>
     
</div>


</nav>
</body>
</html>