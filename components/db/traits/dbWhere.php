<?php

namespace Components\db\traits;

trait dbWhere
{

    //Operation function where

    private static function isStringOnOrWhere($column, $where, $sign): string
    {
        return " OR `{$column}` {$sign} '{$where}';";
    }

    private static function isArrayOnOrWhere($column): string
    {
        $arr = [];

        foreach ($column as $key => $value) {
            $arr[] = "`{$key}` = '{$value}'";
        }
        $result = implode(' OR ', $arr);

       return " OR {$result}";
    }


    //Operation function orWhere

    private static function isStringAndWhere($column, $where, $sign): string
    {
        return " WHERE `{$column}` {$sign} '{$where}'";
    }

    private static function isArrayAndWhere($column,string $action = 'WHERE'): string
    {
        $arr = [];

        foreach ($column as $key => $value) {

            if(is_array($value)){

                foreach ($value as $col => $val){
                    $arr[] = "`{$key}`.`{$col}` = '{$val}'";
                }

            }else{
                $arr[] = "`{$key}` = '{$value}'";
            }

        }

        return " {$action} " .implode(' AND ', $arr);

    }


}