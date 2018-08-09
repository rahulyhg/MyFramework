<?php

namespace Components\core;

use Components\core\treits\globalFunction;

class super_array
{
    use globalFunction;

    public static $name_array = [];


    public static function createMethodForArrays(array $arr,string  $arguments)
    {
        super_array::$name_array = $arr;
        return super_array::getArray($arguments);
    }

    public function add(string $key, $value): void
    {
        switch (self::$name_array) {
            case $_SESSION:
                $_SESSION[$key] = $value;
                break;
            case $_GET:
                $_GET[$key] = $value;
                break;
            case $_REQUEST:
                $_REQUEST[$key] = $value;
                break;
            case $_FILES:
                $_FILES[$key] = $value;
                break;
            case $GLOBALS:
                $GLOBALS[$key] = $value;
                break;
            case $_POST:
                $_POST[$key] = $value;
                break;
            case $_SERVER:
                $_SERVER[$key] = $value;
                break;
        }
    }


    public function all(): array
    {
        return self::$name_array;
    }

    //знайти значення в багатовимірному масиві, з строки key1.key2 значень
    private static function searchKey(array $arr, $ses = [])
    {
        if (!empty($arr) && empty($ses) && isset(self::$name_array[$arr[0]])) {
            $key = array_shift($arr);
            return self::searchKey($arr, self::$name_array[$key]);
        }

        if (!empty($arr) && isset($ses[$arr[0]])) {
            $key = array_shift($arr);
            return self::searchKey($arr, $ses[$key]);
        }

        return empty($arr) ? $ses : false;
    }


    private static function getArray(string $arr = '')
    {
        return $arr !== '' ? self::searchKey(explode('.',$arr)) : new self();
    }

}