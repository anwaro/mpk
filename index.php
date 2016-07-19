<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';

function __autoload($class) {
    $file = LIBS . $class .".php";
    if(file_exists($file)){
        require $file;
    }
}

Session::init();

$bootstrap = new Bootstrap();

$bootstrap->init();
