<?php


class indexController extends Controller {

    public function index(){
         $this->view('AllPublic.index',['hello'=>'hello world','kok'=>'rt']);
    }
}


