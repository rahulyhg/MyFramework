<?php

namespace Components\db\traits;

trait dbInsert
{

    private static function into(): string
    {
        return "INSERT INTO " . self::nameClass();
    }


    private static function columnForInsert(): string
    {

        $column = [];

        foreach (self::$request as $key => $values) {
            $column[] = "`{$key}`";
        }
        return "(" . implode(',', $column) . ") ";
    }


    private static function valuesForInsert(): string
    {
        $count = count(self::$request);
        $result = '';
        for ($i = 0; $i < $count; $i++) {
            $result .= '?,';
        }
        return "VALUES(" . preg_replace('/(,)$/', '', $result) . ")";
    }
}