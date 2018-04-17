<?php

class registerController extends Controller{

    public function register(){
        isset($_POST['user']) ? $this->saveRegister() : $this->view('auth.register');
    }

    private function saveRegister(){
        user::saveUser($_POST);
        self::isUser($_POST['user']);
    }



}