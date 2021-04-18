<?php

namespace sqli;

require_once(htmlspecialchars('sqlifilters'));


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

    public function sqli_detect($http_request){
        // TO DO asyncronize for 
    }

}
