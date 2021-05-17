<?php
require_once("../server.php");
require_once("../sendmail.php");
require_once('filters.php');

define("ATTACK_SUBJECT", "ATTENTION SOMEONE IS TRYING TO ATTACK YOUR WEBSITE!!");
define("TABLE_NAME", "Injections");

$data = json_decode(file_get_contents('php://input'), true);
$attack_patterns = get_filters();
is_attack($data);

$attack_type_url = null;
$attack_type_headers = null;


function attack_detect($data, $attack_num)
{
    global $attack_patterns, $attack_type_url, $attack_type_headers;
    $results_array = [];
    foreach ($attack_patterns as $filter) {
        $pattern = $filter['rule'];
        $is_found_decoded = preg_match("/" . $pattern . "/i", urldecode($data));
        if ($is_found_decoded == 1) {
            $attack_type = $filter['tag'];
            if ($attack_type === 'xss') {
                $attack_type  = $attack_type . " reflected";
            }
            if ($attack_num === 1) {
                $attack_type_url =   $attack_type;
            } else {
                $attack_type_headers =   $attack_type;
            }
            $results_array[] =  $filter['description'];
        }
    }
    return $results_array;
}

function is_attack($data)
{
    global $connection, $attack_type_url, $attack_type_headers;
    $array_result_url = attack_detect($data['url'], 1);
    $array_result_headers = attack_detect(json_encode($data['headers']), 2);

    if ($array_result_url == null && $array_result_headers == null) {
        echo "no attack detected function reteruned false\r\n" . urldecode(json_encode($data['url']));
        return false;
    } else {
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        $url_decode = htmlspecialchars($data['url']);
        $headers = htmlspecialchars(urldecode(json_encode($data['headers'])));
        $method = $data['method'];
        $hostname = "http://" . $data['host'];
        $path = htmlspecialchars(urldecode($data['path']));

        if ($array_result_url != null) {
            $attack_description1 = implode("\r\n", $array_result_url);

            $sql = "INSERT INTO Detected_Attacks(date, time, hostname,path,headers,http_method,description,type)
        VALUES ('$date', '$time', '$hostname','$path','$headers', '$method','$attack_description1','$attack_type_url')";
            if ($connection->query($sql) === TRUE) {
                echo "added to db\r\ndate and time: " . $date . " " . $time . "\r\nurl: " . $url_decode . "\r\nattack type: $attack_type_url" . "\r\ndescription: " .  $attack_description1;
            } else {
                echo "fail     " . $connection->error . "  " . $hostname . " $attack_type_url" . " headers: " .  var_dump($headers);
            }
        }
        if ($array_result_headers != null) {
            $attack_description2 = implode("\r\n", $array_result_headers);
            $sql = "INSERT INTO Detected_Attacks(date, time, hostname,path,headers,http_method,description,type)
        VALUES ('$date', '$time', '$hostname','$path','$headers', '$method','$attack_description2','$attack_type_headers')";
            if ($connection->query($sql) === TRUE) {
                echo "\r\nadded to db\r\ndate and time: " . $date . " " . $time . "<br>headers: " . urldecode($headers) . "\nattack type: xss stored" . "\r\ndescription: " .  $attack_description2;
            } else {
                echo "fail     " . $connection->error . "  " . $hostname . " $attack_type_headers" . " headers: " .  var_dump($headers);
            }
        }
        $attack_description = $attack_description1 . "\r\n" . $attack_description2;

        sendmail("anomalydetectionregister@gmail.com", ATTACK_SUBJECT, "A description of attack attempts the attacker been trying:\n\n" . $attack_description);


        return true;
    }
}
