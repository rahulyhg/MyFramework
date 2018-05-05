<?php


class indexController extends Controller {

    public function index(){
         return view('category.index',['hello'=>'hello world','kok'=>'rt']);
    }

    public function kek(){
        echo 'kek';
    }
}


