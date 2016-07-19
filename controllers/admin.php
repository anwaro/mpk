<?php

class Admin extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function login() {
        $this->view->setTitle('Logowanie');
        $this->view->addJS('result');
        
        $this->view->status = $this->model->login();
        
        if($this->view->status[0]){
            $this->view->renderContent('admin/index');
        }else{ 
            $this->view->renderContent('admin/login');
        }
        $this->view->renderPage();
    }
    
    public function logout() {
        $this->model->logout();
    }
    
    public function index( ) {
        $this->view->setTitle('Panel Administracujny');
        
        Auth::handleLogin();
        
        $this->view->renderContent('admin/index');
        $this->view->renderPage();
        
    }
}