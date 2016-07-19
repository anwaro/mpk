<?php

class Driver extends Controller {

    function __construct() {
        Auth::handleLogin();
        parent::__construct();
    }
    
    function index() {
    
    }
    
    public function add() {
        $this->view->setTitle('Dodaj nowego kierowce');        
        $this->view->status = $this->model->add();        
        
        $this->view->renderContent('driver/add');
        $this->view->renderPage();
        
    }
    
    public function edit($id) {
        $this->view->setTitle('Edytuj dane kierowcy');        
        $this->view->status = $this->model->edit($id);        
        
        $this->view->renderContent('driver/edit');
        $this->view->renderPage();
        
    }
    
    public function remove($id) {
        $this->view->setTitle('Usuń kierowce z bazy');        
        $this->view->status = $this->model->remove($id);        
        
        $this->view->renderContent('driver/remove');
        $this->view->renderPage();
        
    }
    
    public function info($id) {
        $this->view->setTitle('Info');        
        $this->view->data = $this->model->info($id); 
        $this->view->comp = $this->model->compl($id);
        
        $this->view->renderContent('driver/info');
        $this->view->renderPage();
        
    }
    
    public function replace($id) {
        $this->view->setTitle('Zamiana');        
        $this->view->status = $this->model->replace($id); 
        $this->view->data = $this->model->getDriver($id);        
        
        $this->view->renderContent('driver/replace');
        $this->view->renderPage();
        
    }
}