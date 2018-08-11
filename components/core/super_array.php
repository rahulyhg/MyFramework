<?php

namespace Components\core;

use Components\core\treits\globalFunction;
use Components\Pages\error_page;

class super_array
{
    use globalFunction;

    public static $name_array = [];


    public static function createMethodForArrays(array $arr,string  $arguments)
    {
        super_array::$name_array = $arr;
        return super_array::getArray($arguments);
    }


    public function delete(string $keys): void
    {
        if (self::searchValueInArray(explode('.', $keys))) {

            try {
                eval(self::createStringCodeToEvalDelete($keys));
            } Catch (\ParseError $e) {
                error_page::showPageError("Delete in eval method is failed", $e->getMessage(). ' ' . $e->getFile() . $e->getLine());
            }

        } else {
            dump(self::$name_array);
            error_page::showPageError("NOT FIND {$keys} TO ARRAY");
        }
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
            case $_FILES:
                $_FILES[$key] = $value;
                break;
            case $_POST:
                $_POST[$key] = $value;
                break;
            default:
                error_page::showPageError("Not found super_array",'Not found name');
        }
    }

    public function destroy(): void
    {
        switch (self::$name_array) {

            case $_SESSION:
                $_SESSION = [];
                break;
            case $_GET:
                $_GET = [];
                break;
            case $_FILES:
                $_FILES = [];
                break;
            case $_POST:
                $_POST = [];
                break;
            default:
                error_page::showPageError("Not found super_array to destroy",'Found: session,get,files,post');
        }
    }

    public function all(): array
    {
        return self::$name_array;
    }

    private static function createStringCodeToEvalDelete(string $keys): string
    {
        $result  = self::getToStringNameSuperArray();

        $result .= self::getToStringKeysArray($keys);

        return "unset($result);";
    }


    private static function getToStringNameSuperArray()
    {
        switch (self::$name_array) {
            case $_SESSION:
                return '$_SESSION';
            case $_GET:
                return '$_GET';
            case $_FILES:
                return  '$_FILES';
            case $_POST:
                return '$_POST';
            default:
                error_page::showPageError("Not found super_array",'Not found name to delete: post/get/files/session');
        }
    }


    private static function getToStringKeysArray(string $keys): string
    {
        $result = '';

        $keys = explode('.', $keys);

        foreach ($keys as $key) {
            $result .= "['$key']";
        }

        return $result;
    }



    //знайти значення в багатовимірному масиві, з строки key1.key2 значень
    private static function searchValueInArray(array $keys, $array_with_keys = [])
    {
        if (!empty($keys) && empty($array_with_keys) && isset(self::$name_array[$keys[0]])) {
            $key = array_shift($keys);
            return self::searchValueInArray($keys, self::$name_array[$key]);
        }

        if (!empty($keys) && isset($array_with_keys[$keys[0]])) {
            $key = array_shift($keys);
            return self::searchValueInArray($keys, $array_with_keys[$key]);
        }

        return empty($keys) ? $array_with_keys : false;
    }


    private static function getArray(string $arr = '')
    {
        return $arr !== '' ? self::searchValueInArray(explode('.',$arr)) : new self();
    }

}