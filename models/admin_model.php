<?php

class Admin_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function index( ) {
        
    }
    
     
    public function logout() {
        Session::destroy();
        header('location: ' . URL .  'admin/login');
        exit;
    }
    
    public function login() {
        if($this->is_post("login")){
            $username = strtoupper ($this->post("username"));
            $userpassword =  Hash::create('sha256',$this->post("userpass"), HASH_PASSWORD_KEY);
            $data = $this->db->exe("SELECT login('$username')", 1)[0][0];
            
            
            if(str_replace(' ', '', $data) ==''){            
               return [0, "Nie ma  użytkowika o nicku ".$username];
            }
            elseif($data  != $userpassword){ 
                    return [0, "Podano złe hasło"];
            }
            elseif($data){
                

                Session::set('login', true);
                Session::set('userlogin', $username);           

                return [1, ""];           
            }
        }
        else {
            return [0, ""];
        }
    }
        
}
