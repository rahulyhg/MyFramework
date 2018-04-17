<?php


class authController extends Controller {

    public function getLogin(){
        isset($_POST['user']) ? $this->ifIssetPost($_POST) : $this->view('auth.auth');
    }

    private function ifIssetPost($post){
        $password = user::whereLogin($post['user']) ;
          $password  ? $this->passwordTrue($post,$password) : $this->view('auth.auth',['error' => 'Такого юзера не існує']);
    }

    private function passwordTrue($post,$password){
        $post['password'] == $password ? self::isUser($post['user']) : $this->view('auth.auth', ['error' => 'Невірний пароль']);

    }

}