<?php
/**
 * 
 */
class Auth
{
    
    public static function handleLogin()
    {
        $logged = $_SESSION['login'];
        if ($logged == false) {
            session_destroy();
            header('location: '. URL .'admin/login');
            exit;
        }
    }
    
    public static function isLogin() {
        return array_key_exists ("login", $_SESSION) &&  $_SESSION["login"];
    }
    
}