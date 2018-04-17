<?php

class authMiddleware extends Middleware implements middlewareInterface
{

    public function run(){
        isset($_POST['exit']) ? self::exitUser() : '';

        if(!isset($_SESSION['user'])) {
           $this->requestLoginUrl();
        }
       $this->headerIfUrlLogin();
    }

    private function requestLoginUrl(){
        $_SERVER['REQUEST_URI'] !== '/login' && $_SERVER['REQUEST_URI'] !== '/register' ?  header('Location: /login') : '';
        }

    private function headerIfUrlLogin(){
       isset($_SESSION['user']) && ($_SERVER['REQUEST_URI']  == '/login' || $_SERVER['REQUEST_URI'] == '/register') ?  header('Location: /') : '';
    }



}


