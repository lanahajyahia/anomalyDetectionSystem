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

    li a,
    .dropbtn {
      display: inline-block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none !important;
    }

    li a:hover,
    .dropdown:hover .dropbtn {
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
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content1 a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .navbar-title {
      font-size: 1.235em;
    }

    .navbar-title:hover {
      color: white !important;
    }

    .navbar {
      padding: 0px !important;
      background: #333 !important;
    }

    .dropdown-content1 a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content1 {
      display: block;
    }

    .navbar-div {
      display: initial;
    }

    .username-nav {
      padding-top: 14px;
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header" style="padding-left: 0.5em !important">
        <a class="navbar-brand" href="<?php echo htmlspecialchars('../../admin/dashboard.php'); ?>">Anomaly Detection</a>
      </div>
      <ul>
        <div class="navbar-div">
          <li><a href="<?php echo htmlspecialchars('../../admin/dashboard.php'); ?>">Dashboard</a></li>
        </div>
        <?php if ($_SESSION['user']['user_type'] == "admin") : ?>
          <!-- if admin show users if user hide use -->
          <div class="navbar-div" aria-label="users">
            <li><a href="<?php echo htmlspecialchars('../../admin/users.php'); ?>">Users</a></li>
          </div>
        <?php endif; ?>

        <div class="navbar-div">
          <li><a href="<?php echo htmlspecialchars('../../admin/Logs/sqliLogs.php'); ?>">SQL Injection</a></li>
        </div>
        <div class="navbar-div">
          <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Cross-site scripting</a>
            <div class="dropdown-content1">
              <a href="<?php echo htmlspecialchars('../../admin/Logs/reflectedLogs.php'); ?>">Reflected</a>
              <a href="<?php echo htmlspecialchars('../../admin/Logs/storedLogs.php'); ?>">Stored</a>
            </div>
          </li>
        </div>
        <!-- <div class="navbar-div">
          <li><a href="<?php echo htmlspecialchars('../../admin/Logs/csrfLogs.php'); ?>">CSRF</a></li>
        </div> -->
        <div class="navbar-div">
          <li><a href="<?php echo htmlspecialchars('../../dashboard.php'); ?>">About</a></li>
        </div>
      </ul>

      <ul class=" navbar-right">
        <li class="username-nav"><?php echo $_SESSION['user']['username']; ?></li>
        <li><a href="<?php
        echo htmlspecialchars('../../login.php'); ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>


    </div>


  </nav>
</body>

</html>