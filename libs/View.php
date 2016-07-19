<?php

class View {
    
    public $components = array(
        "js" => "",
        "title" => "Witam na mojej stronie",
        "nav" => "nawigacja",
        "meta" => "",
        "content" => "content",
        "css" => "",       
        "url" => URL,
        "fullurl"=> "",
        "image" => "public/images/stat/logo256.jpg",
        "descr" => "komunikacja",
        "menu" => ''
    );
    
    public function __set($name, $value) {
        $this->components[$name] = $value;
    }
    
    public function __get($name) {
        return $this->components[$name];        
    }
            

    function __construct() {
        $this->components["fullurl"] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
    }

    public function renderPage()
    {
        $file ="views/template.php";
        echo preg_replace_callback('/{%([^%]+)%}/', 'self::getComponents', implode('', file($file)));
    }
    
    public function renderContent($name) {
        ob_start();
        require 'views/' . $name . '.php';          
        $buffer = ob_get_contents();        
        ob_end_clean();
        
        if(Auth::isLogin()){
            $this->components["menu"] = str_replace("{%url%}", URL,implode('', file("views/menu.admin.php")));
        }else{
            $this->components["menu"] = str_replace("{%url%}", URL,implode('', file("views/menu.user.php")));            
        }
        $this->components["content"] = str_replace("{%url%}", URL, $buffer);
    }
    
    public function addJs($name) {
        $this->components["js"].= "<script src='".URL."public/js/".str_replace(" ", "",$name).".js'></script> \n\t\t";
    }
    
    public function addCss($name) {        
        $this->components["css"].= '<link rel="stylesheet"  href="'.URL.'public/css/'.str_replace(" ", "",$name).'.css" >' ."\n\t\t";
    }
    
    public function addMataData($key, $value){
        $this->components["metadata"].= '<meta name="'.$key.'" content="'.$value.'" />'."\n\t\t";
    }
    
    public function setTitle($title) {
        $this->components["title"]=$title;
    }
    
    
    public function setOgTags($info) {
        $this->components["image"] = IMAGE_DIR . "/" . $info["photo"];
        $this->components["descr"] = $info["descr"];        
    }
    
    private function getComponents($name) {
        return $this->components[$name[1]];        
    }
    
    public function tableHead($data){
        
        $ret = "";
        if(is_array($data)){
            if(is_array($data[0])){
                $data = $data[0];
            }
            foreach ($data as $key => $val){
                $ret.="<td>$key</td>"; 
            }
        }
        return $ret;
    }

    public function tableBody($data){
        
        $ret = '';
        if(is_array($data)){
            if(is_array($data[0])){
                foreach ($data as $d){
                    $ret.=$this->tableBody($d);
                }
            }
            else{
                $ret.="<tr> ";
                foreach ($data as $d){
                    $ret.="<td>".substr ($d,0,30) ."</td>";
                }
                $ret.="</tr> ";
            }
        }
        return $ret;    
    }
}