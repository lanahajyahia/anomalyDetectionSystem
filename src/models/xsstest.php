<?php

namespace xss;

include("xssCheck.php");

$xss_detection = new xssCheck();
$harm_string = '<body onBeforeUnload body onBeforeUnload="javascript:javascript:alert(1)"></body onBeforeUnload>';

echo $harm_string . "dfs";
echo '</br>';

$cars = array('BM','BM','<body onBeforeUnload body onBeforeUnload="javascript:javascript:alert(1)"></body onBeforeUnload>','BM','<body onBeforeUnload body onBeforeUnload="javascript:javascript:alert(1)"></body onBeforeUnload>', 'Toyota'); 
echo is_array($cars);
$harmless_xss = $xss_detection->xss_clean($cars);
if ($xss_detection->isXssFound()) {
  echo " injection " . $harmless_xss;
} else {
   echo " no injection " . $harmless_xss;
}