<?php

// namespace sqli;

require_once('sqlifilters.php');
// require('../sendmail.php');
require('../server.php');
define("ATTACK_SUBJECT", "ATTENTION SQL injection attack alert!!");
define("TABLE_NAME", "SQL_injections");
// class sqliDetection
// {

$data = json_decode(file_get_contents('php://input'), true);
// echo $data;
//var_dump($data);


// echo "WE ARE HERE";
// die();

// if(isset($_POST['data'])) {
//     echo "hi";
// }

is_sqli($data);


function sqli_detect($string)
{
    // TO DO asyncronize for 

    // $encoded_string = $string;
    //  $decoded_string =  urldecode($string);
    $sqli_filters = get_filters();
    $results_array = [];
    foreach ($sqli_filters as $filter) {
        $pattern = $filter['rule'];
        $is_found_decoded = preg_match("/" . $pattern . "/i", $string);
        // $is_found_encoded = preg_match("/" . $pattern . "/i", $string);

        if ($is_found_decoded == 1 ) {

            $results_array[] =  $filter['description'];
        }
    }
    return $results_array;
}

function is_sqli($data)
{
    global $connection;
    $array_result = sqli_detect($data['url']);
    if ($array_result == null) {
        return false;
    } else {
        $attack_description = implode("\r\n", $array_result);
        // session mail of user....
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        $url_decode = urldecode($data['url']);
        $method = $data['method'];
        $sql = "INSERT INTO SQL_injections (date, time, http_url,http_method,description,type)
        VALUES ('$date', '$time', '$url_decode', '$method','$attack_description','sqli')";
        if ($connection->query($sql) === TRUE) {
            echo "succed";
        } else {
            echo "  fail     ";
        }
        // sendmail("anomalydetectionregister@gmail.com", ATTACK_SUBJECT, "Someone is trying to hack your website\n" . $attack_description);
        return true;
    }
}
