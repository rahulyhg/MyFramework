<?php

class database{

    public static $pdo_object;

    public static function getConnection(){
        if(empty(self::$pdo_object)){
            $paramsPath =  'config/db_params.php';
            $params = include($paramsPath);
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            try {
                $db = new PDO($dsn, $params['user'], $params['password']);
                $db->exec("set names utf8");
                return self::$pdo_object = $db;
            }catch (PDOException $c){
                $c->getMessage();
            }
        }
        return self::$pdo_object;
    }

}
