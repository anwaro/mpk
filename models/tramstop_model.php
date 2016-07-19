<?php

class Tramstop_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
    
    }
    
    public function add() {
        if($this->is_post("addtramstop")){
            $numer = intval($this->post("numer"));
            $nazwa = $this->post("nazwa");
            $x = doubleval($this->post("x"));
            $y = doubleval($this->post("y"));
            $result = $this->db->exe("SELECT dodaj_przystanek($numer, '$nazwa', $x, $y)", 1)[0][0];
            //$result = 1;
            
            
            if($result){
                return [1, "Dodano nowy przystanek (nr: $numer, nazwa: $nazwa)"];
            }else{
                return [0, "Istnieje inny przystanek o nr: $numer"];
            }
        }
        else{
            return [1, ""];
        }
    }
    
    public function edit($id) {
        $status =[0, "", ['1','','','','']];
        if($this->is_post("edittramstop")){
            $numer = intval($this->post("numer"));
            $nazwa = $this->post("nazwa");
            $x = doubleval($this->post("x"));
            $y = doubleval($this->post("y"));
            
            $result = $this->db->exe("SELECT edytuj_przystanek($id, $numer, '$nazwa', $x, $y)", 1)[0][0];
            
            if($result){
                $status[1]= "Zedytowano przystanek (nr: $numer, nazwa: $nazwa)";
            }else{
                $status[1]= "Istnieje inny przystanek o nr: $numer";
            }
            
        }
        $status[2] = $this->db->exe("SELECT przystanek_info($id)", 1)[0];
        return $status;
        
        
    }
    
    public function remove($id) {
        $status =[0, "", ['','','','','']];
        $linie = '';
        $status[2] = $this->db->exe("SELECT przystanek_info($id)", 1)[0];
        
        
        if($this->is_post("removetramstop")){
            
            
            $result = $this->db->exe("SELECT usun_przystanek($id)", 1)[0][0];
            
            
            if($result){
                $status[1]= "Usunieto przystanek";
            }else{
                
                $linie = implode(", ", $this->db->exe("SELECT linie_z_przystankiem($id)", 1)[0]);
                $status[1]= "Nie można usunąć przystanku ponieważ powiazane są z nim linie tramwajowe. ";
                $status[1].= "Aby usunąć przystanek zmodyfikuj linie:<span class='fontcolor'> $linie</span>";
            }
            
        }
        
        return $status;
        
    }
}
