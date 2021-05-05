<?php 

var_dump(shell_exec('test.py "hi"'));
// $output = shell_exec($command);
// var_dump($output);

if( shell_exec('python test.py') == "hi")
{
   echo "yy";
}
?>