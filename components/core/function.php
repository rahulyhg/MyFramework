<?php

    function db(){
        return database::getConnection();
    }

    function dump($array){
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

    function en(array $arr){
        return $arr[count($arr)-1];
    }


