<?php

namespace Components\db;

use Components\Pages\error_page;

class database{

    private static $pdo_object;

    public static function getConnection(): \PDO{

        if(empty(self::$pdo_object)){

            $params = require_once 'config/db_params.php';

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

            try {
                $db = new \PDO($dsn, $params['user'], $params['password']);

                $db->exec("set names utf8");
                self::$pdo_object = $db;
                return self::$pdo_object;

            }catch (\PDOException $c){
                error_page::showPageError('Database not found.Not valid db_params',$c);
            }
        }

        return self::$pdo_object;
    }

}
