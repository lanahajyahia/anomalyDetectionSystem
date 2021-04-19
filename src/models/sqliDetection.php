<?php

namespace sqli;

require_once('sqlifilters.php');

class sqliDetection
{

    public function sqli_detect($string)
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
}
