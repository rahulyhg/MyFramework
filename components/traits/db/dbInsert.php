<?php

trait dbInsert
{

    private static function into(): string{
        return "INSERT INTO ". self::nameClass();
    }

    private static function columnForInsert(array $arr): string{
        foreach($arr as $key => $values){
            $column[] = "`{$key}`";
        }
        return "(".implode(',',$column).") ";
    }

    private static function valuesForInsert(array $arr): string
        {
        foreach ($arr as $key => $value) {
            $values[] = "'{$value}'";
        }
        return "VALUES(" . implode(',', $values) . ")";
    }
}