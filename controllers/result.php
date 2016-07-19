<?php

class Result extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function connection() {
        $this->view->setTitle('Home');
        $this->view->addJS('result');
        
        $this->view->connectionInfo = $this->model->getConnectionInfo();
        $this->view->renderContent('result/connection');
        $this->view->renderPage();
        
    }
    
    function line($id = NULL) {
        $this->view->setTitle('Home');
        $this->view->addJS('result');
        
        $this->view->data= $this->model->geLinetInfo($id);
        $this->view->renderContent('result/line');
        $this->view->renderPage();
        
    }
    
    function tramstop() {
        $this->view->setTitle('Home');
        $this->view->addJS('result');
        
        $this->view->schedule = $this->model->getSchedule();
        $this->view->renderContent('result/tramstop');
        $this->view->renderPage();
        
    }
    
    
    function l($id = NULL) {
        
        $st  = $this->model->geLinetInfo($id)[0];
      ?>
<style>
            body
            {
                width: 282px;
                margin: 0px;
            }.title h2 {
                font-size: 1em;
                color: #FFF;
                font-weight: 400;
                margin: 0;
                padding: 0;
            }
            .tram:active, .current {
                background: #197D62;
            }
            .title {
                width: 282px;
                background: rgba(56, 56, 56, 0.9);
                
            }
            iframe{
                position: absolute;
                z-index: -1;
                height: 98%;
                width: 98%;
                left:0;
                top:0;
            }
            #show{
                height: 30px;
                width: 30px;
                background: #197D62;
            }
        </style>
        
        <script>
            function show(){
                var div = document.getElementById('stop');
                if (div.style.display !== 'none') {
                    div.style.display = 'none';
                    document.body.style.width = 0;
                }
                else {
                    document.body.style.width = "282px";
                    div.style.display = 'block';
                }
            }
        </script>
        <div id="show" onclick="show()"></div>
        <div class="title" id="stop">
        <?php
        foreach($st as $stop){
            if($stop[3] ==0 ){
                $info = " (" .$stop[0] . ')';
            }
            else{
                $info = ' (ready)';
            }
            echo '<h2 id = '.$stop[0]." class='tram' data-line=''>". $stop[2] .$info.'</h2>';
        }
        ?>
        </div>
        <iframe src="http://krakow.jakdojade.pl/"></iframe>
        <?php
        
    }
    
}