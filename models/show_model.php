<?php

class Show_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function driver( ) {
        $data = $this->db->exe("SELECT * FROM kierowcy");
        return $data;
    }
    
    
    
    public function line( ) {
        $data = $this->db->exe("SELECT * FROM lista_lini ORDER BY numer");
        return $data;
    }
    
    public function tramstop() {
        $data = $this->db->exe("SELECT * FROM przystanki  ORDER BY  nazwa");
        return $data;
    }
    
}