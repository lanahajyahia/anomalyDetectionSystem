<?php
   namespace xss;
   include("xssDetection.php");

   $xss_detection = new xssDetection();
   //$harm_string = 'https://www.php.net/name=<META HTTP-EQUIV="refresh"CONTENT="0;url=data:text/html;base64,PHNjcmlwdD5hbGVydCgndGVzdDMnKTwvc2NyaXB0Pg">';
   //$harm_string = 'http://example.com/index.php?user=<script>window.onload = function() {var AllLinks=document.getElementsByTagName("a");AllLinks[0].href = "http://badexample.com/malicious.exe"; }</script>';
   $harm_string = 'GET /packet.php?rq=f4b944b191b197db&things=2&total=%3Cscript%3Ealert%28123%29%3C%2Fscript%3E Headers
   Host: localhost
   User-Agent: python-requests/2.25.1
   Accept-Encoding: gzip, deflate
   Accept: */*
   Connection: keep-alive
   ';
   echo urlencode("https://insecure-website.com/products?category=Gifts'+OR+1=1--");
   // echo '</br>';
   // echo urldecode("https%3A%2F%2Finsecure-website.com%2Fproducts%3Fcategory%3DGifts%27%2BOR%2B1%3D1--");
   echo $_SERVER['REQUEST_METHOD'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 
   echo '</br>';
   
   $harmless_xss = $xss_detection->xss_clean($harm_string);
   if($xss_detection->isXssFound()){
   // echo "injection " . $harmless_xss;
    }else{
   // echo "no injection " . $harmless_xss;
     }
?>