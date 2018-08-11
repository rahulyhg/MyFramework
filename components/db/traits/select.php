<?php


namespace Components\db\traits;


trait select
{
    private static function ecranSelectColumn(array $select): string
    {

        $arr = [];

        foreach ($select as $key => $value) {

            if (is_array($value)) {

                foreach ($value as $column) {

                    if($column !== '*'){
                       $column = "`{$column}` ";
                    }

                    array_push($arr, "`{$key}`.".$column);
                }

            } else {
                array_push($arr," `{$value}` ");
            }

        }

        return implode(',', $arr);
    }

    private static function editColumnNameToEcranSymbol(string $column): string
    {
        $result = [];
        $column = explode('.',$column);
        foreach ($column as $key){
            $result[]= "`$key`";
        }
        return implode('.',$result);
    }



}