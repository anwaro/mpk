<?php

class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        
        //$this->db->exec("set names utf8");
    }
    
    
    /**
     * 
     *  Zwraca element tablicy $_POST
     * 
     * @param string $name nazwa elementu tablicy $_POST
     * @return string|NULL
     */
    public function post($name) {
        $return= filter_input_array(INPUT_POST);
        return array_key_exists($name, $return)?$return[$name]:NULL;
    }
    
    
    /**
     * 
     *  Sprawdza czy wysłano formularz
     * 
     * @param string $name nazwa pola formularzu
     * @return bool
     */
    public function is_post($name) {
        return filter_input(INPUT_POST, $name)?1:0;
    }

}