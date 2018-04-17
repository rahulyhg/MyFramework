<?php

class postMiddleware extends Middleware implements middlewareInterface{

    public function run(){
        if(!empty($_POST)){
            foreach ($_POST as $key =>$value){
                $_POST[$key] = preg_replace("/(\r\n)/", "<br/>", $value);
            }
        }
    }
}