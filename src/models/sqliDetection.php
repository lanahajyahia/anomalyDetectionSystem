<?php

namespace sqli;

require_once('sqlifilters.php');

class sqliDetection
{
    private $sqli_found;
    private $sqli_description;
    private $sqli_impact;

    // Getters and setters
    public function set_sqli_found($sqli_found)
    {
        $this->sqli_found = $sqli_found;
    }
    public function is_sqli_found()
    {
        return $this->sqli_found;
    }
    public function set_sqli_description($sqli_description)
    {
        $this->sqli_description = $sqli_description;
    }
    public function get_sqli_description()
    {
        return $this->sqli_description;
    }

    public function sqli_detect($http_request)
    {
        // TO DO asyncronize for 
        $sqli_filters = get_filters();
        foreach ($sqli_filters as $filter) {
            $pattern = $filter['rule'];

            $is_found = preg_match("/". $pattern."/i", $http_request) ;

            if ($is_found == 1) {
                //echo $filter['rule'];
               
                $this->sqli_found = true;
                echo $filter['description'];
                $this->sqli_description = $filter['description'];
                // break;
            }
           
        }
    }
}
