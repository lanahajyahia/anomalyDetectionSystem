<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$result = mail("hajyahial@gmail.com","My subject",$msg,"From: anomalydetectionregister@gmail.com");

echo var_dump($result);
echo "</br>";
echo $result;
?>