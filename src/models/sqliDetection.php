<?php

// namespace sqli;

require_once('sqlifilters.php');
require('sendmail.php');
define("ATTACK_SUBJECT", "ATTENTION SQL injection attack alert!!");

// class sqliDetection
// {

function sqli_detect($string)
{
    // TO DO asyncronize for 
    $sqli_filters = get_filters();
    $results_array = [];
    foreach ($sqli_filters as $filter) {
        $pattern = $filter['rule'];

        $is_found = preg_match("/" . $pattern . "/i", $string);

        if ($is_found == 1) {

            $results_array[] = $filter['description'];
        }
    }
    return $results_array;
}

function is_sqli($string)
{
    $array_result = sqli_detect($string);
    if ($array_result == null) {
        return false;
    } else {
        $attack_description = implode("\r\n", $array_result);
        // session mail of user....
        sendmail("anomalydetectionregister@gmail.com", ATTACK_SUBJECT, "Someone is trying to hack your website\n" . $attack_description);
        return true;
    }
}
