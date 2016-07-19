<?php

class Search_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function searchTramStop() {
        if ($this->is_post('name')){
            $tramStop = $this->post('name');
            $data =$this->db->exe("SELECT szukaj_przystanku('%$tramStop%')", 1);
            
            
            return json_encode($data);
        }
        
    }
    
    public function getAllLine() {
        return $this->db->exe('SELECT * FROM lista_lini');
    }
    
    
}
