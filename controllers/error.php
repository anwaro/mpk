<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->setTitle('Nie znaleziono danej strony');
        
        $this->view->renderContent('error/index');
        $this->view->renderPage();
        
    }
    
}