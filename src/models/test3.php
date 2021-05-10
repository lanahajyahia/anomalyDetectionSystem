<?php

require_once('filters.php');

$patt = "((,*)((NULL,*)|(CHAR(\d+)\+*)|(UNION ALL SELECT \d,*))( |#|--)*)";
$patt1 = "(UNION ALL SELECT \d,*)( |#|--)*)";
//  $string = "SELECT * FROM books where NAME LIKE '%why' UNION (SELECT 2, COLUMN_NAME, 3 FROM information_schema.columns WHERE TABLE_NAME = 'users'); -- %'";
 $string = "<IMG SRC=x ondragend=\"alert(String.fromCharCode(88,83,83))\"> ";

$filters = get_filters();
$results_array = [];
$reep = $string;
echo htmlentities($string);
foreach ($filters as $filter) {
  $pattern = $filter['rule'];
  $pattern = "/" . $pattern . "/i";
  $is_found_decoded = preg_match_all( $pattern  , urldecode($string));
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