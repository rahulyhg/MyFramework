<?php

    function db(){
        return database::getConnection();
    }

    function dump(array $array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    function dd($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        die;
    }

    function view(string $url,array $variable = null){

        $url = str_replace('.','/',$url);

        if($variable !== null) {
            extract($variable, EXTR_PREFIX_SAME, "wddx");
        }

        return require_once "views/$url.php";
    }

    function en(array $arr){
        return $arr[count($arr)-1];
    }


