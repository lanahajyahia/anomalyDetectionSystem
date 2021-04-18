<?php
  //  namespace xss;
  //  include("xssDetection.php");

  //  $xss_detection = new xssDetection();
  //  //$harm_string = 'https://www.php.net/name=<META HTTP-EQUIV="refresh"CONTENT="0;url=data:text/html;base64,PHNjcmlwdD5hbGVydCgndGVzdDMnKTwvc2NyaXB0Pg">';
  //  //$harm_string = 'http://example.com/index.php?user=<script>window.onload = function() {var AllLinks=document.getElementsByTagName("a");AllLinks[0].href = "http://badexample.com/malicious.exe"; }</script>';
  //  $harm_string = 'GET /packet.php?rq=f4b944b191b197db&things=2&total=%3Cscript%3Ealert%28123%29%3C%2Fscript%3E Headers
  //  Host: localhost
  //  User-Agent: python-requests/2.25.1
  //  Accept-Encoding: gzip, deflate
  //  Accept: */*
  //  Connection: keep-alive
  //  ';
  //  echo urlencode("https://insecure-website.com/products?category=Gifts'+OR+1=1--");
  //  // echo '</br>';
  //  // echo urldecode("https%3A%2F%2Finsecure-website.com%2Fproducts%3Fcategory%3DGifts%27%2BOR%2B1%3D1--");
  //  echo $_SERVER['REQUEST_METHOD'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 
  //  echo '</br>';
   
  //  $harmless_xss = $xss_detection->xss_clean($harm_string);
  //  if($xss_detection->isXssFound()){
  //  // echo "injection " . $harmless_xss;
  //   }else{
  //  // echo "no injection " . $harmless_xss;
  //    }

  namespace sqli;

  include("models/sqliDetection.php");
  $detect = new sqliDetection();
  // $string_ = "id=1+and+ascii(lower(mid((select+pwd+from+users+limit+1,1),1,1)))=74";
  // $string_ = "https://insecure-website.com/products?category=Gifts'-- ";

  // $string_ = "SELECT * FROM products WHERE category = 'Gifts'--' AND released = 1";

  // $string_ = " UNION ALL SELECT 'INJ'||'ECT'||'XXX',2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30  ";
  // $string_ = '";waitfor delay "0:0:5"-- ';
$string_ = "%2c(select%20*%20from%20(select(sleep(10)))a)


";
  $detect->sqli_detect($string_);
   //echo preg_match("/(?:(sleep\\((\\s*)(\\d*)(\\s*)\\)|benchmark\\((.*)\\,(.*)\\)))/i",$string_);
  //  echo $detect->get_sqli_description();

?>