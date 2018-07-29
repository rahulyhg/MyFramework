<?php

class database{

    private static $pdo_object;

    public static function getConnection(): PDO{

        if(empty(self::$pdo_object)){

            $params = require_once '/config/db_params.php';

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

            try {
                $db = new PDO($dsn, $params['user'], $params['password']);

                $db->exec("set names utf8");

                return self::$pdo_object = $db;

            }catch (PDOException $c){
                die('Database not found.Not valid db_params');
            }
        }

        return self::$pdo_object;
    }

}
