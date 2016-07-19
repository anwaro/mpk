<?php

class Complaint extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index( ) {
        
    }
    
    public function add( ) {        
        $this->view->setTitle('Dodaj skargę');
        $this->view->addJs('search');
        
        $this->view->status = $this->model->addComplaint();        
        $this->view->allLine = $this->model->getAllLine();
        
        $this->view->renderContent('complaint/add');
        $this->view->renderPage();
    }
    
    public function remove($id) {
        Auth::handleLogin();
        $this->view->setTitle('Usuń skargę');
        
        $this->view->status = $this->model->remove($id);
        $this->view->renderContent('complaint/remove');
        $this->view->renderPage();
        
    }
    
    public function show( ) {
        Auth::handleLogin();
        $this->view->setTitle('Wyświetl skragi');
        
        
        $this->view->renderContent('complaint/show');
        $this->view->renderPage();
        
    }
}