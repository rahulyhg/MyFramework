<?php

namespace Components\db\traits;

trait dbWhere
{

    //Operation function where

    private static function isStringOnOrWhere($column, $where, $sign): void
    {
        self::$sql .= " OR `{$column}` {$sign} '{$where}';";
    }

    private static function isArrayOnOrWhere($column): void
    {
        $arr = [];

        foreach ($column as $key => $value) {
            $arr[] = "`{$key}` = '{$value}'";
        }
        $result = implode(' OR ', $arr);

        self::$sql .= " OR {$result}";
    }


    //Operation function orWhere

    private static function isStringOnWhere($column, $where, $sign): void
    {
        self::$sql .= " WHERE `{$column}` {$sign} '{$where}'";
    }

    private static function isArrayOnWhere($column): void
    {
        $arr = [];

        foreach ($column as $key => $value) {
            $arr[] = "`{$key}` = '{$value}'";
        }
        $result = implode(' AND ', $arr);
        self::$sql .= " WHERE {$result}";
    }
}