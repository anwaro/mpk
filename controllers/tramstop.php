<?php

class Tramstop extends Controller {

    function __construct() {
        Auth::handleLogin();
        parent::__construct();
    }
    
    function index() {
    
    }
    
    public function add() {
        $this->view->setTitle('Dodaj przystanek');        
        $this->view->status = $this->model->add();        
        
        $this->view->renderContent('tramstop/add');
        $this->view->renderPage();
        
    }
    
    public function edit($id) {
        $this->view->setTitle('Edytuj przystanek');        
        $this->view->status = $this->model->edit($id);        
        
        $this->view->renderContent('tramstop/edit');
        $this->view->renderPage();
        
    }
    
    public function remove($id) {
        $this->view->setTitle('Usuń przystanek');        
        $this->view->status = $this->model->remove($id);        
        
        $this->view->renderContent('tramstop/remove');
        $this->view->renderPage();
        
    }
}
