<?php


trait dbWhere
{

    //Operation function where

    private static function isStringOnOrWhere($column,$where,$sign){
        self::$sql .= " OR {$column} {$sign} '{$where}';";
    }

    private static function isArrayOnOrWhere($column){
        foreach ($column as $key => $value){
            $arr[]= "{$key} = '{$value}'";
        }
        $result = implode(' OR ',$arr);
        self::$sql .= " OR {$result}";
    }


    //Operation function orWhere

    private static function isStringOnWhere($column,$where,$sign){
        self::$sql .= " WHERE {$column} {$sign} '{$where}';";
    }

    private static function isArrayOnWhere($column){
        foreach ($column as $key => $value){
            $arr[]= "{$key} = '{$value}'";
        }
        $result = implode(' AND ',$arr);
        self::$sql .= " WHERE {$result}";
    }
}