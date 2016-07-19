<?php

class Search extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->setTitle('Szukaj połączenia');
        
        $this->view->addJS('search');
        
        $this->view->renderContent('szukaj/index');
        $this->view->renderPage();
        
    }
    
    function connection($link = NULL) {
        $this->view->setTitle('Szukaj | Połączenie');
        $this->view->addJS('search');
        
        $this->view->renderContent('search/connection');
        $this->view->renderPage();
        
    }
    
    function line() {
        $this->view->setTitle('Szukaj | Linie');
        $this->view->addJS('search');
        
        $this->view->allLine = $this->model->getAllLine();
        
        $this->view->renderContent('search/line');
        $this->view->renderPage();
        
    }
    
    function tramstop() {
        $this->view->setTitle('Szukaj | Przystanki');
        $this->view->addJS('search');
        $this->view->renderContent('search/tramstop');
        $this->view->renderPage();
        
    }
    
    function ajax($type){
        if($type == 'tramstop'){
            echo $this->model->searchTramStop();
        }
    }
    
}