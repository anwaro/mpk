<?php

class Complaint_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
    
    }
    
    public function addComplaint( ) {
        if($this->is_post('addcomplaint')){
            $lineId = $this->post('lineId');
            $tramstopstartId = $this->post('tramstopstartID');
            $timeStart = $this->post('timeStart');
            $complaint = $this->post('complaint');
            
            $driverId = $this->db->exe("SELECT szukaj_kierowcy($lineId, $tramstopstartId, '$timeStart')", 1)[0][0];
            if ($driverId != '0'){                
                $this->db->exe("SELECT dodaj_skarge($driverId, '$complaint')", 1);
            return [1, "Dodano skargę "];
                
            }
            return [1, "Nie odnaleziono kierowcy podaj dokłądniejsze dane"];
        }
        
        return [1, ""];
    }
    
    public function remove($id ) {
        $status[] = 0;
        $status[] = '';
        $status[] = $this->db->exe("SELECT * FROM skargi WHERE id = $id")[0];
        $status[] = $this->db->exe("SELECT kierowca_info(".$status[2][1].")",1)[0];
        
        
        if($this->is_post('removecomplaint')){
            $this->db->exe("SELECT usun_skarge($id)", 1);
            $status[1] = "Usunieto skargę";
            $status[0] = 1;
        }
        
        return $status;
    }
    
    public function show( ) {
        
        
    }
    
    public function getAllLine() {
        return $this->db->exe('SELECT * FROM lista_lini');
    }
}
