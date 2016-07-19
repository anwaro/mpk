<?php

class Line extends Controller {

    function __construct() {
        Auth::handleLogin();
        parent::__construct();
    }
    
    function index() {
    
    }
    
    public function addroute() {
        $this->view->setTitle('Dodaj nową linię'); 
        $this->view->addJs("script");
        
        
        $this->view->status = $this->model->addLineRoute();         
        $this->view->tramstops = $this->model->getTramstop();
        
        $this->view->renderContent('line/addroute');
        $this->view->renderPage();
        
    }
    
    public function editroute($id) {
        $this->view->setTitle('Edytuj linię'); 
        $this->view->addJs("script");
        
         
        $this->view->status = $this->model->editroute($id);
        $this->view->line = $this->model->lineInfo($id);         
        $this->view->tramstops = $this->model->getTramstop();   
        $this->view->tramstopsInLine = $this->model->getTramstopInLine($id);
        
        $this->view->renderContent('line/editroute');
        $this->view->renderPage();
        
    }
    
    public function remove($id) {
        $this->view->setTitle('Usuń linię');  
        
        $this->view->status = $this->model->remove($id);        
        
        $this->view->renderContent('line/remove');
        $this->view->renderPage();
        
    }
    
    public function info($id) {
        $this->view->setTitle('Info');       
        
        $this->view->data = $this->model->info($id);        
        
        $this->view->renderContent('line/info');
        $this->view->renderPage();
        
    }
    
    public function editschedule($id) {
        $this->view->setTitle('Dodaj/Edytuj/Usuń wyjazdy tramwaju');    
        $this->view->addJs("script");
        
        $this->view->status = $this->model->editschedule($id); 
        $this->view->data = $this->model->info($id); 
        $this->view->tramlist = $this->model->tramlist(); 
        $this->view->driverlist = $this->model->driverlist(); 
        
        
        $this->view->renderContent('line/editschedule');
        $this->view->renderPage();
        
    }
    
    public function times(){
        echo $this->model->timeBetween();
    }
}