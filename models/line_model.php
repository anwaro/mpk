<?php

class Line_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
    
    }
    
    
    public function editroute($id) {
        $status =[0, "", ['','','','','']];
        if($this->is_post("editlineroute")){
            $this->db->exe("DELETE FROM przystanki_na_trasie WHERE linie_id = $id");
            $status = $this->addLineRoute($id);
        }
        return $status;
        
    }
    
    public function addLineRoute($id = NULL) {
        $status =[0, "", ['','','','','']];
        
        if($this->is_post('addlineroute')  || $this->is_post("editlineroute")){
            $add  = $this->is_post("addlineroute")?1:0;
            $number = $this->post('linenumber');
            $tramstop = $this->post('tramstop');
            $time = $this->post('time');
            $tramstopStart= $this->post('tramstopStart');
            $tramstopStop = $this->post('tramstopStop');
            
            $c = $this->db->exe("SELECT COUNT(*) FROM linie WHERE numer = $number"
                    . "AND petla_poczatkowa = $tramstopStart AND petla_koncowa = $tramstopStop")[0][0];
            
            
            if($c != 0 && $add){
                $status[1] = "Istneije już taka linia";
                return $status;
            }
            
            $count = $this->db->exe("SELECT kierunek FROM linie WHERE numer = $number"
                . "AND petla_poczatkowa = $tramstopStop AND petla_koncowa =$tramstopStart ");
            $kierunek = 1;
            if(!empty($count)){
                $kierunek = $count[0][0]?1:0;
            }
            
            
            //jezeli update'ujemy linie nie musimy jej juz dodawac
            if($add){
               $this->db->exe("INSERT INTO linie VALUES(DEFAULT, $number,"
                    . " $tramstopStart, $tramstopStop, $kierunek)");
            }else{
                $this->db->exe("UPDATE linie SET petla_poczatkowa = $tramstopStart,"
                    . " petla_koncowa = $tramstopStop WHERE id=$id");
            }

            array_unshift($tramstop, $tramstopStart);
            array_push($tramstop, $tramstopStop);

            for($i =0 ; $i<count($tramstop)-1;$i++){
                $this->db->exe("INSERT INTO przystanki_na_trasie VALUES(DEFAULT, "
                        . "l_id($number,$kierunek),".$tramstop[$i]
                        . "," .$tramstop[$i+1].", $i)");
                
                $t = $this->db->exe("SELECT czas_przystanki(".$tramstop[$i].","
                        .$tramstop[$i+1].")", 1)[0][0];

                if(floatval($t) == 0){
                    $tim = explode(":", $time[$i]);
                    $tim = intval($tim[0]) + intval($tim[1])/60;
                    $this->db->exe("INSERT INTO czasy_miedzy_przystankami VALUES(DEFAULT, "
                        .$tramstop[$i]. "," .$tramstop[$i+1].",". $tim);
                }
            }
            
            $status[1] =$add?"Dodano nową linię ":"Wprowadzono nowe dane trasy";
            
            $status[2] =$this->db->exe("SELECT * FROM lista_lini WHERE id = l_id($number,$kierunek)")[0];
                
        }
        return $status;
        
    }
    
    public function editschedule($id) {
        if($this->is_post("editschedule")){
            $tram =  $this->post("tramid");
            $driver = $this->post("driverid");
            $time = $this->post("schedule");
            
            
            $this->db->exe("DELETE FROM wyjazdy WHERE linie_id = $id");
            
            $stmt = $this->db->prepare("INSERT INTO wyjazdy (id, linie_id, tramwaje_id, kierowcy_id, godzina)"
                    . " VALUES (DEFAULT, $id, :val1, :val2, :val3)");

            $this->db->beginTransaction();
            
            for($i=0; $i<count($tram);$i++) {
                $stmt->execute([
                    ':val1' => $tram[$i],
                    ':val2' => $driver[$i],
                    ':val3' => "'".$time[$i]."'",
                ]);
            }
            $this->db->commit();
        }
         
        
    }
    
    public function tramlist() {
        return $this->db->exe("SELECT * FROM tramwaje");
    }
    
    public function driverlist() {
        return $this->db->exe("SELECT * FROM kierowcy");
    }
    
    
    public function remove($id) {
        $status =[0, "", ['','','','','']];
        $info =$this->db->exe("SELECT * FROM lista_lini WHERE id = $id");
        if(empty($info)){
            $status[1] ="Nie ma takiej lini";
            return $status;
        }
        $status[2] = $info[0];
        
        
        if($this->is_post('removeline')){
            $this->db->exe("SELECT usun_linie($id)");
            $status[1] ="Usunięto linię ";
        }
        
        return $status;
    }
    
    public function getTramstop() {
        return $this->db->exe("SELECT * FROM przystanki ORDER BY nazwa");
    }
    
    public function getTramstopInLine($id) {
        return $this->db->exe("SELECT przystanki_na_lini($id)", 1);
    }
    
    public function info($tramLine) {
        
        $data = [];
        
        $allTramStop = $this->db->exe("SELECT przystanki_na_lini($tramLine)", 1);


        $tramstopid = $this->is_post('tramstop-number')?$this->post('tramstop-number'):$allTramStop[0][0];

        $allDeparture = $this->db->exe("SELECT pokaz_rozklad_na_przystanku_danej_lini($tramstopid, $tramLine)", 1);
        $lineInfo = $this->db->exe(" SELECT *  FROM lista_lini  WHERE id = $tramLine");


        array_push($data, $allTramStop, $allDeparture, $lineInfo[0], $tramstopid);
        
        
        return $data;
    }
    
    public function timeBetween() {
        $data = json_decode($this->post('tramstop'));
        
        $time = [];
        for($i=0; $i<count($data)-1;$i++){
            $t = $this->db->exe("SELECT czas_przystanki(".$data[$i].",".$data[$i+1].")", 1)[0][0];
            $t = floatval($t);
            if($t!=0){
                $m = floor($t);
                $s = floor(($t*60)%60);
                array_push($time, ($m<10?("0".$m):$m) .":". ($s<10?("0".$s):$s) );
            }
            else{
                array_push($time, 0);
            }
        }
        return json_encode($time);
        
    }
    
    public function lineInfo($id) {
        return $this->db->exe("SELECT linia_info($id)", 1)[0];
    }
    
}
