<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->setTitle('Home');
        $this->view->renderContent('index/index');
        $this->view->renderPage();
        
    }    
   
    function student(){
        echo $this->model->getStudent();
    }
    
}