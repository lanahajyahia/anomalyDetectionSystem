<?php

require_once('filters.php');

$patt = "((,*)((NULL,*)|(CHAR(\d+)\+*)|(UNION ALL SELECT \d,*))( |#|--)*)";
$patt1 = "(UNION ALL SELECT \d,*)( |#|--)*)";
//  $string = "SELECT * FROM books where NAME LIKE '%why' UNION (SELECT 2, COLUMN_NAME, 3 FROM information_schema.columns WHERE TABLE_NAME = 'users'); -- %'";
//  $string = '{"host":"aba.myspecies.info","user-agent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0","accept":"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8","accept-language":"en-US,en;q=0.5","accept-encoding":"gzip, deflate","content-type":"application/x-www-form-urlencoded","content-length":"156","origin":"http://aba.myspecies.info","connection":"keep-alive","referer":"http://aba.myspecies.info/search/site/%3Cscript%5Cx0A%3Ejavascript%3Aalert%281%29%3C%252fscript%3E","cookie":"has_js=1; Drupal.visitor.name=test1; Drupal.visitor.mail=test%40trst.aaa; has_js=1","upgrade-insecure-requests":"1"}';
// $string = "{&quot;host&quot;:&quot;aba.myspecies.info&quot;,&quot;user-agent&quot;:&quot;Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0&quot;,&quot;accept&quot;:&quot;text/html,application/xhtml xml,application/xml;q=0.9,image/webp,*/*;q=0.8&quot;,&quot;accept-language&quot;:&quot;en-US,en;q=0.5&quot;,&quot;accept-encoding&quot;:&quot;gzip, deflate&quot;,&quot;referer&quot;:&quot;http://aba.myspecies.info/&quot;,&quot;connection&quot;:&quot;keep-alive&quot;,&quot;cookie&quot;:&quot;has_js=1; Drupal.visitor.name=; Drupal.visitor.mail=; has_js=1&quot;,&quot;upgrade-insecure-requests&quot;:&quot;1&quot;}	";
 $string ='http://aba.myspecies.info/search/site/%3Cscript%3Ealert%281%29%3C%252fscript%3E';
$filters = get_filters();
$results_array = [];
$reep = $string;
echo htmlentities(urldecode($string));
foreach ($filters as $filter) {
  $pattern = $filter['rule'];
  $pattern = "/" . $pattern . "/i";
  $str = (urldecode($string));
  $is_found_decoded = preg_match_all( $pattern  , $str);
  // echo htmlentities(urldecode($string));
  // echo $is_found_decoded . "<br>";
  // $is_found_encoded = preg_match("/" . $pattern . "/i", $string);
  // preg_replace($pattern, "replaced", urldecode($reep));
  if ($is_found_decoded > 0) {
    
 echo "<br>";
    // echo $is_found_decoded . "<br>";
    echo $filter['description'] . "<br>";
    echo $filter['tag'] . "<br>";
    $results_array[] =  $filter['description'];
  }
}
// echo $reep;