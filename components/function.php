<?php

    function db(){
        return database::getConnection();
    }

    function dump(array $array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
