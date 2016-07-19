<?php

class Result_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function getConnectionInfo() {
        if ($this->is_post('connectionsearch')){
            $tramStopStart = $this->post('tramstopstart');
            $tramStopStartId = $this->post('tramstopstartID');
            $tramStopStop = $this->post('tramstopstop');
            $tramStopStopId = $this->post('tramstopstopID');
            
            $timeStart = $this->post('timeStart');
            
            $linie = $this->db->exe("SELECT szukaj_polaczenia($tramStopStartId, $tramStopStopId)",1);
            
            $data = [];
            
            foreach ($linie as $lina) {
                $lineId = $lina[0];
                $p1Id = $lina[1];
                $p2Id = $lina[2];
                
                $item = $this->db->exe(
                        "SELECT pokaz_rozklad_na_przystanku_danej_lini_czas("
                        ."$lineId ,$p1Id , $p2Id, '$timeStart')" , 1);
                
                $lineInfo = $this->db->exe("SELECT * FROM lista_lini WHERE id = $lineId");
                
                array_push($data, [$item, $lineInfo[0], $tramStopStart, $tramStopStop]);
            }
            
            return $this->fix_array($data);
            
        }
        
    }
    
    public function fix_array($lines) {
        
        $data = [];
        foreach ($lines as $line){
            $lineId = $line[1][0];
            $lineNr = $line[1][1];
            $lineStart = $line[1][2];
            $lineStop =  $line[1][3];
            $tramStart = $line[2];
            $tramStop = $line[3];
            foreach ($line[0] as $time) {
                if(strlen($time[0])>2){
                    
                    array_push($data,[$lineId, $lineNr, $lineStart, 
                                $tramStart, str_replace(" ", "" ,$time[0]), $tramStop, 
                                $time[1], $lineStop]);
                }               
            }
        }
        usort($data, function ($item1, $item2) {
            return strnatcmp ($item1[4], $item2[4]);
        });
        return $data;
    }
    
    public function getSchedule() {
        if ($this->is_post('tramstop')){
            $tramStopStartId = $this->post('tramstopstartID');
            
            $data = [];
            
            $allTramStop = $this->db->exe("SELECT przystanki_o_takiej_samej_nazwie($tramStopStartId)", 1);
            
            
            
            foreach ($allTramStop as $tramStop) {
                $schedule = $this->db->exe("SELECT pokaz_rozklad_na_przystanku(".$tramStop[0].")", 1);
                
                
                $info = $this->allInfo($schedule, $tramStop[0]);
                
                
                for($i=0;$i<count($info);$i++){
                    array_push($data, $info[$i]);
                }
                
            }
            
            return $data;
        }
    }
    
    public function allInfo($schedule, $tramStopStartId) {
        $data =[];
        $schedule_line = [];
        $linia_id = $schedule[0][1];
        
        for($i=0;$i<count($schedule);$i++){
            if($schedule[$i][1] == $linia_id && $i != count($schedule)-1){
                array_push($schedule_line, $schedule[$i]);
            }else{
                $linie = $this->db->exe("SELECT *  FROM lista_lini  WHERE id = $linia_id");
                $tramStopInLine = $this->db->exe("SELECT przystanki_na_lini($linia_id)", 1);
                $tramStopInfo = $this->db->exe("SELECT przystanek_info($tramStopStartId)", 1);
                array_push($data, [ $tramStopInLine, $this->sort_by_time($schedule_line), $linie[0], $tramStopInfo[0]]);
                $schedule_line = [];
                $linia_id = $schedule[$i][1];
                array_push($schedule_line, $schedule[$i]);
            }
        }
        
        
        return $data;
    }
    
    function geLinetInfo($id) {
        
        $data = [];
        
        if ($this->is_post('tramline') || $id){
            $tramLine = $this->is_post('line-number')?$this->post('line-number'):$id;
            $allTramStop = $this->db->exe("SELECT przystanki_na_lini($tramLine)", 1);
            
           
            $tramstopid = $this->is_post('tramstop-number')?$this->post('tramstop-number'):$allTramStop[0][0];
            
            $allDeparture = $this->db->exe("SELECT pokaz_rozklad_na_przystanku_danej_lini($tramstopid, $tramLine)", 1);
            $lineInfo = $this->db->exe(" SELECT *  FROM lista_lini  WHERE id = $tramLine");
            
            
            array_push($data, $allTramStop, $this->sort_by_time($allDeparture), $lineInfo[0], $tramstopid);
        }
        
        return $data;
    }
    
    public function sort_by_time($array){
        
        usort($array, function ($item1, $item2) {
            return strnatcmp ($item1[4], $item2[4]);
        });
        
        return $array;
        
    }
    
}
