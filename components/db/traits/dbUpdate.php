<?php


trait dbUpdate
{

    private static function updateSql(): string{
        return "UPDATE ". self::nameClass();
    }

    private static function set(): string{
        foreach (self::$request as $key => $value){
            $result[]= "{$key} = ?";
        }
        return " SET ". implode(',',$result);
    }
}