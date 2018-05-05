<?php
require_once 'config/listDerectoryAutoload.php';

class autoload{

    public  function autoload(){
     spl_autoload_register(function ($class_name) {
         $path = new listDerectoryAutoload;
         $path = $path->listDirectory();
         foreach ($path as $key) {
             $url = "$key/" . $class_name . '.php';
             if(is_file($url)){
                 require_once $url;
                    }
              }
         });
    }

}
