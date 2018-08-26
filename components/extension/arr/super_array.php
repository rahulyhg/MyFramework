<?php

namespace Components\extension\arr;

use Components\core\treits\globalFunction;
use Components\Pages\error_page;

class super_array
{

    public static $name_array;



    public static function all(): array
    {
        return self::$name_array;
    }

    public function delete($keys): void
    {
        $keys = explode('.',$keys);
        self::searchValueInArray($keys) ? self::searchAndDeleteKey($keys) : error_page::showPageError('This Key not find in array','code #364jhre');
    }


    public static function createArr($keys = '',array &$arr)
    {
        self::$name_array =& $arr;

        return   $keys == '' ? new self() : self::searchValueInArray(explode('.',$keys));
    }

    public function add(string $key,$value): void
    {
        self::$name_array[$key] = $value;
    }



    private  function searchAndDeleteKey(array $keys, &$childArr = [])
    {
        if (!empty($keys) && empty($childArr) && isset(self::$name_array[$keys[0]])) {
            $key = array_shift($keys);
            if(count($keys) == 0){
                unset(self::$name_array[$key]);
                return ;
            }
            return self::searchAndDeleteKey($keys, self::$name_array[$key]);
        }

        if (count($keys) == 1) {
            $key = array_shift($keys);
            unset($childArr[$key]);
        }

        if (!empty($keys) && isset($childArr[$keys[0]])) {
            $key = array_shift($keys);
            return self::searchAndDeleteKey($keys, $childArr[$key]);
        }
    }


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


}