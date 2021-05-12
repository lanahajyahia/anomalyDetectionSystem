<?php
require_once("../server.php");
require_once("../sendmail.php");
require_once('filters.php');

define("ATTACK_SUBJECT", "ATTENTION SOMEONE IS TRYING TO ATTACK YOUR WEBSITE!!");
define("TABLE_NAME", "Injections");

$data = json_decode(file_get_contents('php://input'), true);
$attack_patterns = get_filters();
is_attack($data);

$attack_type = null;

function attack_detect($string)
{
    global $attack_patterns, $attack_type;
    $results_array = [];
    foreach ($attack_patterns as $filter) {
        $pattern = $filter['rule'];
        $is_found_decoded = preg_match("/" . $pattern . "/i", urldecode($string));
        if ($is_found_decoded == 1) {
            $attack_type = $filter['tag'];
            if($attack_type === 'xss'){
                $attack_type  = $attack_type . " stored";
            }
            $results_array[] =  $filter['description'];
        }
    }
    return $results_array;
}

function is_attack($data)
{
    global $connection, $attack_type;
    $array_result = attack_detect($data['url']);
    if ($array_result == null) {
        // echo "null";
        return false;
    } else {
        $attack_description = implode("\r\n", $array_result);
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        $url_decode = htmlspecialchars($data['url']);
        $headers = json_encode($data['headers']);
        $method = $data['method'];
        $hostname = "http://" . $data['host'];
        $path = htmlspecialchars(urldecode($data['path']));
        // $http_url = $data[''];
        $sql = "INSERT INTO Detected_Attacks(date, time, hostname,path,headers,http_method,description,type)
        VALUES ('$date', '$time', '$hostname','$path','$headers', '$method','$attack_description','$attack_type')";
        if ($connection->query($sql) === TRUE) {
            echo "succed " . $url_decode . " $attack_type" . " headers: " .  var_dump($headers);
        } else {
            echo "  fail     " . $connection->error . "  " . $hostname . " $attack_type" . " headers: " .  var_dump($headers);
        }
        //sendmail("anomalydetectionregister@gmail.com", ATTACK_SUBJECT, "A description of attack attemps the hacker been trying:\n\n" . $attack_description);
        return true;
    }
}
