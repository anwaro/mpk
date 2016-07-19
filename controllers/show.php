<?php

class Show extends Controller {

    function __construct() {
        
        Auth::handleLogin();
        parent::__construct();
    }
    
    function index() {        
        $this->view->setTitle('Wbierz listę');        
        $this->view->drivers = $this->model->driver();        
        
        $this->view->renderContent('show/index');
        $this->view->renderPage();
    }
    
    function driver() {        
        $this->view->setTitle('Wszyscy przcownicy');        
        $this->view->drivers = $this->model->driver();        
        
        $this->view->renderContent('show/driver');
        $this->view->renderPage();
    }
    
    function line() {        
        $this->view->setTitle('Wszystkie linie');        
        $this->view->lines = $this->model->line();        
        
        $this->view->renderContent('show/line');
        $this->view->renderPage();
    }
    
    function tramstop() {        
        $this->view->setTitle('Wszystkie przystanki');        
        $this->view->tramstops = $this->model->tramstop();        
        
        $this->view->renderContent('show/tramstop');
        $this->view->renderPage();
    }
}