<?php

namespace Components\db;

use Components\Pages\error_page;

/**
 * Class database
 * @package Components\db
 */

class database{

    private static $pdo_object;

    /**
     * @return \PDO
     */

    public static function getConnection(): \PDO
    {
        if(empty(self::$pdo_object)){

            $params = require_once 'config/db_params.php';

            try {
                self::$pdo_object = new \PDO("mysql:host={$params['host']};dbname={$params['dbname']}", $params['user'], $params['password']);

                self::$pdo_object->exec("set names utf8");

                return self::$pdo_object;

            }catch (\PDOException $c){
                error_page::showPageError('Database not found.Not valid db_params code: #2354235',$c);
            }
        }

        return self::$pdo_object;
    }

}
