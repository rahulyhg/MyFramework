<?php

class database{
    
    public static function getConnection(){
        $paramsPath =  'config/db_params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        try {
            $db = new PDO($dsn, $params['user'], $params['password']);
            $db->exec("set names utf8");
            return $db;
        }catch (PDOException $c){
            $c->getMessage();
        }
    }

}
