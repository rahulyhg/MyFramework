<?php


trait dbUpdate
{
//UPDATE people SET `people`='kek',`kek`=45
    private static function updateSql(){
        return "UPDATE ". self::nameClass();
    }

    private static function set(array $arr){
        foreach ($arr as $key => $value){
            $result[]= "{$key} = '{$value}'";
        }
        return " SET ". implode(',',$result);
    }
}