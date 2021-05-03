<?php

// namespace xss;

// include("models/xssDetection.php");

// $xss_detection = new xssDetection();
// //$harm_string = 'https://www.php.net/name=<META HTTP-EQUIV="refresh"CONTENT="0;url=data:text/html;base64,PHNjcmlwdD5hbGVydCgndGVzdDMnKTwvc2NyaXB0Pg">';
// //$harm_string = 'http://example.com/index.php?user=<script>window.onload = function() {var AllLinks=document.getElementsByTagName("a");AllLinks[0].href = "http://badexample.com/malicious.exe"; }</script>';
// // $harm_string = 'GET /packet.php?rq=f4b944b191b197db&things=2&total=%3Cscript%3Ealert%28123%29%3C%2Fscript%3E Headers
// //    Host: localhost
// //    User-Agent: python-requests/2.25.1
// //    Accept-Encoding: gzip, deflate
// //    Accept: */*
// //    Connection: keep-alive
// //    ';
// // $harm_string = 'http://testsite.test/<script>alert("TEST");</script>';
// // $harm_string = 'aba.myspecies.info/search/lana/<img src%3D"http%3A%2f%2furl.to.file.which%2fnot.exist" onerror%3Dalert(document.cookie)%3B>'; 
// $harm_string = "aba.myspecies.info/search/site/%3CSCRIPT%20type%3D%22text%2Fjavascript%22%3E%20var%20adr%20%3D%20%27..%2Fevil.php%3Fcakemonster%3D%27%20%2B%20escape%28document.cookie%29%3B%20%3C%2FSCRIPT%3E";
// // "<SCRIPT type='text/javascript'>var adr = '../evil.php?cakemonster=' + escape(document.cookie);</SCRIPT>";
// //  echo urlencode("https://insecure-website.com/products?category=Gifts'+OR+1=1--");
// // echo '</br>';
// // echo urldecode("https%3A%2F%2Finsecure-website.com%2Fproducts%3Fcategory%3DGifts%27%2BOR%2B1%3D1--");
// //  echo $_SERVER['REQUEST_METHOD'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

// echo '</br>';

// $harmless_xss = $xss_detection->xss_clean($harm_string);
// if ($xss_detection->isXssFound()) {
//   echo "injection " . $harmless_xss;
// } else {
//   // echo "no injection " . $harmless_xss;
// }

namespace sqli;

include("models/sqliDetection.php");
$data = json_decode(file_get_contents('php://input'), true);
var_dump($data);
// $detect = new sqliDetection();
// $string_ = "id=1+and+ascii(lower(mid((select+pwd+from+users+limit+1,1),1,1)))=74";
// $string_ = "https://insecure-website.com/products?category=Gifts'-- ";

// $string_ = "SELECT * FROM products WHERE category = 'Gifts'--' AND released = 1";

// $string_ = " http://www.example.com/something?name= UNION ALL SELECT 'INJ'||'ECT'||'XXX',2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30  ";
// $string_ = '";waitfor delay "0:0:5"-- ';
// $string_ = " ORDER BY 1,SLEEP(5),BENCHMARK(1000000,MD5('A')),4,5,6,7,8)";
// $string_ = 'http://acunetix.php.example/wordpress/wp-content/plugins/demo_vul/endpoint.php?user=1+ORDER+BY+10';
 $string_ = " ' GROUP BY columnnames having 1=1 -- ";
// $string_ = " ORDER BY 1,SLEEP(5),BENCHMARK(1000000,MD5('A')),4,5,6,7,8,9,10,11,12,13";
 $ss = urldecode($string_);
  echo $ss;

var_dump(is_sqli($ss));
   // echo preg_match("/(?:(sleep\\((\\s*)(\\d*)(\\s*)\\)|benchmark\\((.*)\\,(.*)\\)))/i",$string_);
   // echo $detect->get_sqli_description();
?>
   <!-- <script>
function myFunction() {
  var str = "-1+union+select+1,2,3,4,5,6,7,8,9,(SELECT+group_concat(table_name)+from+information_schema.tables+where+table_schema=database())"; 
  var results = decodeURI(str);
  var res = results.match(/(?:union\\s*(?:all|distinct|[(!@]*)\\s*[([]*\\s*select)|(?:\\w+\\s+like\\s+\\\")|(?:like\\s*\"\\%)|(?:\"\\s*like\\W*[\"\\d])|(?:\"\\s*(?:n?and|x?or|not |\\|\\||\\&\\&)\\s+[\\s\\w]+=\\s*\\w+\\s*having)|(?:\"\\s*\\*\\s*\\w+\\W+\")|(?:\"\\s*[^?\\w\\s=.,;)(]+\\s*[(@\"]*\\s*\\w+\\W+\\w)|(?:select\\s*[\\[\\]()\\s\\w\\.,\"-]+from)|(?:find_in_set\\s*\\()/i);
}
</script> -->
