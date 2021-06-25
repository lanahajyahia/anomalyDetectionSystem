<?php

use SendGrid\Response;

require_once("../server.php");
require_once("../sendmail.php");
require_once('filters.php');

define("ATTACK_SUBJECT", "ATTENTION SOMEONE IS TRYING TO ATTACK YOUR WEBSITE!!");

$data = json_decode(file_get_contents('php://input'), true);

$attack_patterns = get_filters();
is_attack($data);

$attack_type_url = "";
$attack_type_headers = "";
$attack_type_body = "";

function attack_detect($data, $attack_num)
{
    global $attack_patterns, $attack_type_url, $attack_type_headers, $attack_type_body;
    $results_array = [];
    foreach ($attack_patterns as $filter) {
        $pattern = $filter['rule'];
        $is_found_decoded = preg_match("/" . $pattern . "/i", urldecode($data));
        if ($is_found_decoded == 1) {
            $attack_type = $filter['tag'];
            if ($attack_type === 'xss') {
                $attack_type = "xss reflected";
            }
            if ($attack_num === 1) {
                $attack_type_url =   $attack_type;
            } else if ($attack_num === 2) {
                $attack_type_headers =   $attack_type;
            } else {
                $attack_type_body = $attack_type;
            }
            $results_array[] =  $filter['description'];
        }
    }
    return $results_array;
}

function is_attack($data)
{
    global $connection, $attack_type_url, $attack_type_headers, $attack_type_body;
    $array_result_url = attack_detect($data['url'], 1);
    $array_result_body = attack_detect($data['body_string'], 3);
    $array_result_headers = attack_detect(json_encode($data['headers']), 2);


    if ($array_result_url == null && $array_result_headers == null &&  $array_result_body == null) {
        echo "no attack detected function reteruned false\r\n" . urldecode(json_encode($data['url']));
    } else {
        date_default_timezone_set('Asia/Jerusalem');
        $date = date("d-m-Y");
        $time = date("h:i:sa");
        $url_decode = htmlspecialchars($data['url']);
        $headers = htmlspecialchars(urldecode(json_encode($data['headers'])));
        $body = htmlspecialchars(urldecode($data['body_string']));

        $method = $data['method'];
        $hostname = "http://" . $data['host'];
        $path = htmlspecialchars(urldecode($data['url']));
        $_path = mysqli_real_escape_string($connection, $path);
        $_headers = mysqli_real_escape_string($connection, $headers);
        $_body = mysqli_real_escape_string($connection, $body);

        if ($array_result_url != null) {
            $attack_description1 = implode("\r\n", $array_result_url);

            $sql = "INSERT INTO Detected_Attacks(date, time, hostname,path,headers,http_method,description,type,body)
        VALUES ('$date', '$time', '$hostname','$_path','$_headers', '$method','$attack_description1','$attack_type_url','$_body')";
            if ($connection->query($sql) === TRUE) {
                echo "added to db\r\ndate and time: " . $date . " " . $time . "\r\nurl: " . $url_decode . "\r\nattack type: $attack_type_url" . "\r\ndescription: " .  $attack_description1;
            } else {
                echo "fail     " . $connection->error . "  " . $hostname . " $attack_type_url" . " headers: " .  var_dump($_headers);
            }
        }
        if ($array_result_body != null) {
            $attack_description3 = implode("\r\n", $array_result_body);

            $sql = "INSERT INTO Detected_Attacks(date, time, hostname,path,headers,http_method,description,type,body)
        VALUES ('$date', '$time', '$hostname','$_path','$_headers', '$method','$attack_description3','$attack_type_body','$_body')";
            if ($connection->query($sql) === TRUE) {
                echo "added to db\r\ndate and time: " . $date . " " . $time . "\r\nurl: " . $url_decode . "\r\nattack type: $attack_type_body" . "\r\body: " .  $_body . "\r\ndescription: " .  $attack_description3;
            } else {
                echo "fail     " . $connection->error . "  " . $hostname . " $attack_type_body" . " headers: " .  var_dump($headers);
            }
        }
        if ($array_result_headers != null) {
            $attack_description2 = implode("\r\n", $array_result_headers);
        }
        if ($attack_type_headers  != "") {

            $attack_type = $attack_type_headers . " was detected in headers";
        }
        if ($attack_type_url  != "") {

            $attack_type = $attack_type . "\r\n" . $attack_type_url . " was detected in URL";
        }
        if ($attack_type_body  != "") {
            $attack_type = $attack_type . "\r\n" . $attack_type_body . " was detected in body\r\n";
        }

        $attack_description = $attack_description1 . "\r\n" . $attack_description2 . "\r\n" . $attack_description3;

        // sendmail("anomalydetectionregister@gmail.com", ATTACK_SUBJECT,  $attack_type . "\nA description of attack attempts the attacker been trying:\n" . $attack_description);
    }
}
