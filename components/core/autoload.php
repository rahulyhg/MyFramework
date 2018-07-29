<?php
require_once 'config/listDerectoryAutoload.php';

class autoload{

    public static function autoload_class(){

     spl_autoload_register(function ($class_name) {

         $path = require 'config/listDerectoryAutoload.php';

         foreach ($path as $key) {
             $url = "$key/" . $class_name . '.php';
             if(is_file($url)){
                 require_once $url;
                    }
              }
         });
    }
}
