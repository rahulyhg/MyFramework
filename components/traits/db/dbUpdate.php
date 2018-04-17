<?php


trait dbUpdate
{

    private static function updateSql(){
        return "UPDATE ". self::nameClass();
    }

    private static function set(){
        foreach (self::$request as $key => $value){
            $result[]= "{$key} = ?";
        }
        return " SET ". implode(',',$result);
    }
}