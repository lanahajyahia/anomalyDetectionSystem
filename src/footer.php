<!DOCTYPE html>
<html>
<head>
<style>


/* Footer */
.footer {
  padding: 10px;
  text-align: center;
  background: #ddd;
  margin-top: 5px;
  background: #f1f1f1;
  font-size: 10px !important;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    padding: 0;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .topnav a {
    float: none;
    width: 100%;
  }
}
</style>
</head>
<body>
<div class="footer">
  <h2><?php
echo "<p>Copyright &copy; " . date("Y") . " AnomalyDetectionSystem.com</p>";
?></h2>
</div>

</body>
</html>
