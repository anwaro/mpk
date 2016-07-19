<?php

class Raport extends Controller {

    function __construct() {
        
        Auth::handleLogin();
        parent::__construct();
    }
    
    public function index() {
        $this->view->setTitle('Raporty');    
        
        $this->view->renderContent('raport/index');
        $this->view->renderPage();
    }
}