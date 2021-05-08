<?php

// namespace sqli;
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
    // TO DO asyncronize for 
    // $encoded_string = $string;
    //  $decoded_string =  urldecode($string);
    $results_array = [];
    foreach ($attack_patterns as $filter) {
        $pattern = $filter['rule'];
        $is_found_decoded = preg_match("/" . $pattern . "/i", urldecode($string));
        // echo urldecode($string) . "<br>";
        // $is_found_encoded = preg_match("/" . $pattern . "/i", $string);

        if ($is_found_decoded == 1) {

            echo "found";
            $attack_type = $filter['tag'];
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
        // echo "hi";
        return false;
    } else {
        $attack_description = implode("\r\n", $array_result);
        // session mail of user....
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        $url_decode = urldecode($data['url']);
        $method = $data['method'];
        $sql = "INSERT INTO Detected_Attacks(date, time, http_url,http_method,description,type)
        VALUES ('$date', '$time', '$url_decode', '$method','$attack_description','$attack_type')";
        if ($connection->query($sql) === TRUE) {
            echo "succed";
        } else {
            echo "  fail     " . $url_decode . " $attack_type";
        }
        //   sendmail("anomalydetectionregister@gmail.com", ATTACK_SUBJECT, "A description of attack attemps the hacker been trying:\n\n" . $attack_description);
        return true;
    }
}
