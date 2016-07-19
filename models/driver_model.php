<?php

class Driver_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
    
    }
    
    public function add() {
        if($this->is_post("adddriver")){
            $numer = intval($this->post("numer"));
            $name = $this->post("name");
            $surname = $this->post("surname");
            $year = intval($this->post("year"));
            $result = $this->db->exe("SELECT dodaj_kierowce($numer, '$name', '$surname', $year)", 1)[0][0];
            
            
            if($result){
                return [1, "Dodano nowego kierowce do bazy danych (nr: $numer, $name $surname)"];
            }else{
                return [0, "Istnieje inny kirowca który posiada nr: $numer"];
            }
        }
        else{
            return [1, ""];
        }
    }
    
    public function edit($id) {
        $status =[0, "", ['1','-','-','-','-']];
        if($this->is_post("edittramstop")){
            $numer = intval($this->post("numer"));
            $name = $this->post("name");
            $surname = $this->post("surname");
            $year = intval($this->post("year"));
            
            $result = $this->db->exe("SELECT edytuj_dane_kierowcy($id, $numer, '$name', '$surname', $year)", 1)[0][0];
            //$result = 1;
            
            if($result){
                $status[1]="Zaktualizowano dane kierowcy (nr: $numer, $name $surname)";
            }else{
               $status[1]="Istnieje inny kirowca który posiada nr: $numer";
            }
            
        }
        $status[2] = $this->db->exe("SELECT kierowca_info($id)", 1)[0];
        return $status;
    }
    
    public function remove($id) {
        $status =[0, "", ['1','','','','']];
        
        $status[2] = $this->db->exe("SELECT kierowca_info($id)", 1)[0];
        
        
        if($this->is_post("removedriver")){
            
            
            $result = $this->db->exe("SELECT usun_kierowce_z_bazy($id)", 1)[0][0];
           
            
            if(intval($result)){
                $status[1]= "Usunieto dane kierowce z bazy danych";
            }else{
                
                $status[1]= "Nie mozna usunac danych kierowcy ponieważ wykonuje przejazdy. ";
                $status[1].= "Aby usunąć dane znajdź za niego zastępstwo";
            }
            
        }
        
        return $status;
        
    }
    
    public function info($id) {
        $data = [['1', '', '','', ''], ''];
        $data[0] = $this->db->exe("SELECT kierowca_info($id)", 1)[0];
        $data[1] = $this->db->exe("SELECT kierowca_linia($id)", 1)[0][0];
        return $data;
    }
    
    
    public function replace($id) {
        if($this->is_post("replace")){
            $olddriver = intval($this->post("olddriver"));
            $newdriver = intval($this->post("newdriver"));
            
            
            $this->db->exe("SELECT zamien_kierowcow($olddriver, $newdriver)",1);
        }
        
        $data = [['1', '', '','', ''], ''];
        $data[0] = $this->db->exe("SELECT kierowca_info($id)",1)[0];
        $data[1] = $this->db->exe("SELECT kierowca_linia($id)",1    )[0][0];
        
        
        return $data;
        
    }
    
    public function getDriver($id) {
        
        $stat = $this->db->exe("SELECT kierowca_linia($id)",1)[0][0];
        
        if($stat){
            $data = $this->db->exe("SELECT kierowcy_status($id, 0)",1);
        }
        else {
            $data = $this->db->exe("SELECT kierowcy_status($id, 1)",1);
        }
        

        return $data;
        
    }
    
    public function compl($id) {
        return $this->db->exe("SELECT * FROM skargi WHERE kierowcy_id = $id");
    }
}
