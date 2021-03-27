<?php
namespace xss;

include("../models/xssDetection.php");
session_start();

if(isset($_GET["name"] )){ 
     $url = getCurrentPageURL();
     $xss_detection = new models\xssDetection();
     $harm_string = "<IMG SRC=javascript:alert('XSS')>";
     $harmless_xss = $xss_detection->xss_clean($url);
   if($xss_detection->isXssFound() || strlen($harmless_xss) == 0 ){
      $_SESSION["alert"] = "someone is trying to inject js code in ur website!";
      $_SESSION["injection_type"] ="reflected";
      $_SESSION["injection_description"] ="Detects possible includes and typical script methods";
      $_SESSION["injection_date"] = "" . date("Y/m/d");
      $_SESSION["injection_time"] ="" . date("h:i:sa");
      $_SESSION["injection_url"] = $url;
      header('location: testsfile.php');
   }

}
function getCurrentPageURL()
{
   if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
   $url = "https://";   
   else  
      $url = "http://";   
   // Append the host(domain name, ip) to the URL.   
   $url.= $_SERVER['HTTP_HOST'];   
   
   // Append the requested resource location to the URL   
   $url.= $_SERVER['REQUEST_URI'];   
   return $url;
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="stylee/homestyle.css">

</head>
<body>

<div class="row">
 <?php echo $url;
   echo "</br>";  
 echo $harmless_xss;
 echo "</br>";  
 echo $ $harm_string ;?>
</div>

</body>
</html>