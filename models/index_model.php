<?php

class Index_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    function getStudent(){
        $data = 'HTTP method GET is not supported by this URL';
        if($this->is_post('name')){
            $name = explode(" ", $this->post("name"));
            if(count($name)>1){
                $name1 = $name[0]." ".$name[1];
                $name2 = $name[1]."% ".$name[0];
            }
            else {
                $name1 = $name[0];
                $name2 = $name[0];
            }
            $data = $this->db->exe("SELECT * FROM student".
                    " WHERE LOWER(name) LIKE LOWER('%".$name1."%') ".
                    " OR LOWER(name) LIKE LOWER('%".$name2."%') "
                    . "ORDER BY name  LIMIT 50");
        }
        if($this->is_post('index')){
            $data = $this->db->select("SELECT * FROM student".
                    " WHERE index_nr = :index_nr", array(':index_nr' => $this->post('index')),
                    PDO::FETCH_NUM);
        }
        return json_encode($data);
    }
}
